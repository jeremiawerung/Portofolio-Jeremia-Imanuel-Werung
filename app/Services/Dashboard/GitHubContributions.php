<?php

namespace App\Services\Dashboard;

use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class GitHubContributions
{
    use RemembersLastGood;

    private const LEVELS = [
        'NONE' => 0,
        'FIRST_QUARTILE' => 1,
        'SECOND_QUARTILE' => 2,
        'THIRD_QUARTILE' => 3,
        'FOURTH_QUARTILE' => 4,
    ];

    public function get(): ?array
    {
        $username = config('portfolio.github.username');

        return $this->rememberLastGood(
            'dashboard:github',
            config('portfolio.cache.github'),
            fn () => $this->summarize($username, $this->fetchDays($username)),
        );
    }

    /**
     * @return array<int, array{date: string, count: int, level: int}>
     */
    private function fetchDays(string $username): array
    {
        $token = config('services.github.token');

        return $token
            ? $this->fetchFromGraphql($username, $token)
            : $this->fetchFromPublicApi($username);
    }

    // API resmi GitHub, dipakai kalau GITHUB_TOKEN diisi
    private function fetchFromGraphql(string $username, string $token): array
    {
        $query = <<<'GRAPHQL'
        query($login: String!) {
          user(login: $login) {
            contributionsCollection {
              contributionCalendar {
                weeks { contributionDays { date contributionCount contributionLevel } }
              }
            }
          }
        }
        GRAPHQL;

        $response = Http::withToken($token)
            ->timeout(15)
            ->post('https://api.github.com/graphql', [
                'query' => $query,
                'variables' => ['login' => $username],
            ])
            ->throw();

        $weeks = $response->json('data.user.contributionsCollection.contributionCalendar.weeks');

        if (! is_array($weeks)) {
            throw new RuntimeException('Format GraphQL GitHub gak sesuai');
        }

        $days = [];
        foreach ($weeks as $week) {
            foreach ($week['contributionDays'] as $day) {
                $days[] = [
                    'date' => $day['date'],
                    'count' => (int) $day['contributionCount'],
                    'level' => self::LEVELS[$day['contributionLevel']] ?? 0,
                ];
            }
        }

        return $days;
    }

    // API publik tanpa token (ngebaca grafik di profil GitHub)
    private function fetchFromPublicApi(string $username): array
    {
        $response = Http::timeout(15)
            ->get('https://github-contributions-api.jogruber.de/v4/'.rawurlencode($username), ['y' => 'last'])
            ->throw();

        $contributions = $response->json('contributions');

        if (! is_array($contributions)) {
            throw new RuntimeException('Format API kontribusi gak sesuai');
        }

        return array_map(fn ($day) => [
            'date' => (string) $day['date'],
            'count' => (int) $day['count'],
            'level' => max(0, min(4, (int) $day['level'])),
        ], $contributions);
    }

    private function summarize(string $username, array $days): array
    {
        usort($days, fn ($a, $b) => strcmp($a['date'], $b['date']));

        $total = array_sum(array_column($days, 'count'));
        $best = $days ? max(array_column($days, 'count')) : 0;

        // "This week" ngikutin GitHub: minggu mulai hari Minggu
        $lastDate = $days ? Carbon::parse(end($days)['date']) : now();
        $weekStart = $lastDate->copy()->startOfWeek(Carbon::SUNDAY)->toDateString();
        $thisWeek = array_sum(array_column(
            array_filter($days, fn ($d) => $d['date'] >= $weekStart),
            'count',
        ));

        return [
            'username' => $username,
            'total' => $total,
            'this_week' => $thisWeek,
            'best' => $best,
            'average' => $days ? round($total / count($days), 1) : 0,
            'weeks' => $this->toWeeks($days),
            'updated_at' => now()->toIso8601String(),
        ];
    }

    /**
     * Susun jadi kolom per minggu (Minggu–Sabtu) kayak grafik di GitHub.
     * Hari yang kosong di minggu pertama diisi null biar barisnya pas.
     */
    private function toWeeks(array $days): array
    {
        if (! $days) {
            return [];
        }

        $weeks = [];
        $current = array_fill(0, Carbon::parse($days[0]['date'])->dayOfWeek, null);

        foreach ($days as $day) {
            $current[] = $day;

            if (count($current) === 7) {
                $weeks[] = $current;
                $current = [];
            }
        }

        if ($current) {
            $weeks[] = $current;
        }

        return $weeks;
    }
}
