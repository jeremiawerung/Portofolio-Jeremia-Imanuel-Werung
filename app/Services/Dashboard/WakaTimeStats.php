<?php

namespace App\Services\Dashboard;

use Illuminate\Http\Client\PendingRequest;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;
use RuntimeException;

class WakaTimeStats
{
    use RemembersLastGood;

    public function enabled(): bool
    {
        return filled(config('services.wakatime.key'));
    }

    public function get(): ?array
    {
        if (! $this->enabled()) {
            return null;
        }

        return $this->rememberLastGood(
            'dashboard:wakatime',
            config('portfolio.cache.wakatime'),
            fn () => $this->fetch(),
        );
    }

    private function fetch(): array
    {
        $week = $this->client()->get('users/current/stats/last_7_days')->throw()->json('data');
        $allTime = $this->client()->get('users/current/all_time_since_today')->throw()->json('data');

        if (! is_array($week)) {
            throw new RuntimeException('Format WakaTime gak sesuai');
        }

        $bestDay = $week['best_day'] ?? null;

        return [
            'start_date' => $this->date($week['start'] ?? null),
            'end_date' => $this->date($week['end'] ?? null),
            'daily_average' => $week['human_readable_daily_average'] ?? '-',
            'total_week' => $week['human_readable_total'] ?? '-',
            'best_day' => $bestDay ? [
                'date' => $this->date($bestDay['date'] ?? null),
                'text' => $bestDay['text'] ?? '',
            ] : null,
            'all_time' => $allTime['text'] ?? '-',
            'languages' => $this->top($week['languages'] ?? [], 6),
            'editors' => $this->top($week['editors'] ?? [], 3),
            'updated_at' => now()->toIso8601String(),
        ];
    }

    private function client(): PendingRequest
    {
        // WakaTime minta API key di-base64 terus dikirim lewat header Basic
        return Http::baseUrl('https://wakatime.com/api/v1/')
            ->withHeaders(['Authorization' => 'Basic '.base64_encode(config('services.wakatime.key'))])
            ->acceptJson()
            ->timeout(15);
    }

    private function top(array $items, int $limit): array
    {
        return collect($items)
            ->filter(fn ($item) => ($item['total_seconds'] ?? 0) > 0)
            ->take($limit)
            ->map(fn ($item) => [
                'name' => (string) ($item['name'] ?? '?'),
                'percent' => round((float) ($item['percent'] ?? 0), 1),
                'text' => (string) ($item['text'] ?? ''),
            ])
            ->values()
            ->all();
    }

    private function date(?string $value): ?string
    {
        return $value ? Carbon::parse($value)->toDateString() : null;
    }
}
