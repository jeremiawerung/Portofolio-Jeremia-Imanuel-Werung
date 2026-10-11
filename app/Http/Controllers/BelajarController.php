<?php

namespace App\Http\Controllers;

use App\Models\QuizAttempt;
use App\Models\QuizAttemptAnswer;
use App\Models\QuizQuestion;
use App\Support\Belajar\MateriCatalog;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class BelajarController extends Controller
{
    /**
     * How many questions are drawn at random from a level's question pool
     * for a single quiz attempt. If the pool has fewer than this, the whole
     * pool is used.
     */
    private const ATTEMPT_SIZE = 10;

    public function index(): View
    {
        $blocks = array_map(function (array $block) {
            $block['hasQuiz'] = ! empty($block['quizLevels']);
            return MateriCatalog::stripQuizAnswers($block);
        }, MateriCatalog::all());

        $blocksMeta = array_map(fn (array $b) => [
            'id' => $b['id'],
            'skills' => $b['skills'],
            'available' => $b['status'] === 'available',
        ], $blocks);

        return view('belajar.index', [
            'blocks' => $blocks,
            'blocksMeta' => $blocksMeta,
            'skills' => MateriCatalog::skills(),
        ]);
    }

    public function materi(int $id): View
    {
        $block = MateriCatalog::find($id);
        abort_if(! $block, 404);
        abort_if($block['status'] !== 'available', 404, 'Materi ini belum tersedia.');

        $hasQuiz = ! empty($block['quizLevels']);
        $safeBlock = MateriCatalog::stripQuizAnswers($block);
        $safeBlock['hasQuiz'] = $hasQuiz;
        $safeBlock['quizQuestionCount'] = $hasQuiz
            ? QuizQuestion::where('materi_id', $id)->count()
            : 0;

        return view('belajar.materi', ['block' => $safeBlock]);
    }

    /**
     * Level-select screen: shows Dasar/Menengah/Lanjutan with lock state,
     * pool size, best score so far, and per-category accuracy across all
     * attempts for this materi (weakest category first).
     */
    public function quizLevels(int $id): View
    {
        $block = MateriCatalog::find($id);
        abort_if(! $block, 404);
        abort_if(empty($block['quizLevels']), 404, 'Materi ini belum punya kuis.');

        $levels = $this->buildLevelSummaries($id, $block['quizLevels']);
        $categoryStats = $this->buildCategoryStats($id);

        return view('belajar.quiz-levels', [
            'block' => MateriCatalog::stripQuizAnswers($block),
            'levels' => $levels,
            'categoryStats' => $categoryStats,
        ]);
    }

    public function quiz(int $id, string $level): View|RedirectResponse
    {
        $block = MateriCatalog::find($id);
        abort_if(! $block, 404);
        $levelMeta = $block['quizLevels'][$level] ?? null;
        abort_if(! $levelMeta, 404, 'Level kuis tidak ditemukan.');

        if (! $this->isLevelUnlocked($id, $level, $block['quizLevels'])) {
            return redirect()
                ->route('belajar.quiz.levels', $id)
                ->with('error', 'Level "' . $levelMeta['label'] . '" masih terkunci. Selesaikan level sebelumnya dulu.');
        }

        $pool = QuizQuestion::where('materi_id', $id)->where('level', $level)->get();
        abort_if($pool->isEmpty(), 404, 'Belum ada soal untuk level ini.');

        $picked = $pool->shuffle()->take(self::ATTEMPT_SIZE)->values();

        $questions = $picked->map(fn (QuizQuestion $q) => [
            'id' => $q->id,
            'type' => $q->type,
            'question' => $q->question,
            'options' => $q->options,
        ]);

        return view('belajar.quiz', [
            'block' => MateriCatalog::stripQuizAnswers($block),
            'level' => $level,
            'levelLabel' => $levelMeta['label'],
            'questions' => $questions,
            'poolSize' => $pool->count(),
        ]);
    }

    public function submitQuiz(Request $request, int $id, string $level): View|RedirectResponse
    {
        $block = MateriCatalog::find($id);
        abort_if(! $block, 404);
        $levelMeta = $block['quizLevels'][$level] ?? null;
        abort_if(! $levelMeta, 404, 'Level kuis tidak ditemukan.');

        if (! $this->isLevelUnlocked($id, $level, $block['quizLevels'])) {
            return redirect()
                ->route('belajar.quiz.levels', $id)
                ->with('error', 'Level "' . $levelMeta['label'] . '" masih terkunci.');
        }

        $validated = $request->validate([
            'question_ids' => ['required', 'array', 'min:1'],
            'question_ids.*' => ['integer'],
            'answers' => ['required', 'array'],
            'answers.*' => ['nullable', 'string', 'max:200'],
        ]);

        $questionIds = $validated['question_ids'];
        $questions = QuizQuestion::whereIn('id', $questionIds)
            ->where('materi_id', $id)
            ->where('level', $level)
            ->get()
            ->keyBy('id');

        $total = count($questionIds);
        $answers = $validated['answers'];
        $score = 0;
        $breakdown = [];

        $attempt = QuizAttempt::create([
            'materi_id' => $id,
            'level' => $level,
            'answers' => $answers,
            'score' => 0,
            'total' => $total,
        ]);

        foreach ($questionIds as $qid) {
            $question = $questions->get($qid);
            if (! $question) {
                continue;
            }

            $chosen = $answers[$qid] ?? null;

            if ($question->type === 'fill') {
                $isCorrect = $chosen !== null && in_array($this->normalizeFillAnswer($chosen), $question->accepted, true);
                $breakdown[] = [
                    'type' => 'fill',
                    'q' => $question->question,
                    'category' => $question->category,
                    'chosen' => $chosen,
                    'correctDisplay' => $question->accepted[0],
                    'isCorrect' => $isCorrect,
                    'explain' => $question->explain,
                ];
            } else {
                $isCorrect = $chosen !== null && (int) $chosen === (int) $question->correct;
                $breakdown[] = [
                    'type' => 'mc',
                    'q' => $question->question,
                    'category' => $question->category,
                    'options' => $question->options,
                    'correct' => $question->correct,
                    'chosen' => $chosen === null ? null : (int) $chosen,
                    'isCorrect' => $isCorrect,
                    'explain' => $question->explain,
                ];
            }

            if ($isCorrect) {
                $score++;
            }

            QuizAttemptAnswer::create([
                'quiz_attempt_id' => $attempt->id,
                'quiz_question_id' => $question->id,
                'category' => $question->category,
                'given_answer' => $chosen,
                'is_correct' => $isCorrect,
            ]);
        }

        $attempt->update(['score' => $score]);

        $history = QuizAttempt::where('materi_id', $id)
            ->where('level', $level)
            ->orderBy('created_at')
            ->get();

        $previousAttempt = $history->where('id', '!=', $attempt->id)->last();

        $analysis = [
            'attemptCount' => $history->count(),
            'bestScore' => $history->max('score'),
            'averageScore' => round($history->avg('score'), 1),
            'trend' => $previousAttempt ? $score - $previousAttempt->score : null,
        ];

        $passScore = $levelMeta['passScore'];
        $passed = $passScore !== null && $total > 0 && ($score / $total) >= $passScore;

        $levelOrder = MateriCatalog::levelOrder();
        $currentIndex = array_search($level, $levelOrder, true);
        $nextLevel = $levelOrder[$currentIndex + 1] ?? null;
        $nextLevelUnlockedNow = $passed && $nextLevel && isset($block['quizLevels'][$nextLevel]);
        $nextLevelLabel = $nextLevelUnlockedNow ? $block['quizLevels'][$nextLevel]['label'] : null;

        return view('belajar.quiz-result', [
            'block' => MateriCatalog::stripQuizAnswers($block),
            'level' => $level,
            'levelLabel' => $levelMeta['label'],
            'breakdown' => $breakdown,
            'score' => $score,
            'total' => $total,
            'attempt' => $attempt,
            'history' => $history,
            'analysis' => $analysis,
            'passScore' => $passScore,
            'passed' => $passed,
            'nextLevel' => $nextLevel,
            'nextLevelUnlockedNow' => $nextLevelUnlockedNow,
            'nextLevelLabel' => $nextLevelLabel,
        ]);
    }

    public function apiTester(): View
    {
        return view('belajar.api-tester');
    }

    /**
     * @return array<int, array{key: string, label: string, description: string, unlocked: bool, bestScore: ?int, total: int, attemptCount: int, poolSize: int}>
     */
    private function buildLevelSummaries(int $materiId, array $quizLevels): array
    {
        $summaries = [];
        $levelOrder = MateriCatalog::levelOrder();

        foreach ($levelOrder as $index => $key) {
            if (! isset($quizLevels[$key])) {
                continue;
            }
            $levelMeta = $quizLevels[$key];
            $attempts = QuizAttempt::where('materi_id', $materiId)->where('level', $key)->get();
            $poolSize = QuizQuestion::where('materi_id', $materiId)->where('level', $key)->count();
            $bestAttempt = $this->bestAttemptByPercentage($attempts);

            $previousKey = $levelOrder[$index - 1] ?? null;
            $requiredPrevScore = $previousKey && isset($quizLevels[$previousKey])
                ? $quizLevels[$previousKey]['passScore']
                : null;

            $summaries[] = [
                'key' => $key,
                'label' => $levelMeta['label'],
                'description' => $levelMeta['description'],
                'poolSize' => $poolSize,
                'attemptSize' => min(self::ATTEMPT_SIZE, $poolSize),
                'passScore' => $levelMeta['passScore'],
                'requiredPrevScore' => $requiredPrevScore,
                'unlocked' => $this->isLevelUnlocked($materiId, $key, $quizLevels),
                'attemptCount' => $attempts->count(),
                'bestScore' => $bestAttempt?->score,
                'bestTotal' => $bestAttempt?->total,
            ];
        }

        return $summaries;
    }

    /**
     * Per-category accuracy across every attempt logged for this materi,
     * weakest category first, so the learner can see where to focus next.
     *
     * @return array<int, array{category: string, total: int, correct: int, accuracy: int}>
     */
    private function buildCategoryStats(int $materiId): array
    {
        $rows = QuizAttemptAnswer::whereHas('attempt', fn ($q) => $q->where('materi_id', $materiId))
            ->selectRaw('category, COUNT(*) as total, SUM(CASE WHEN is_correct THEN 1 ELSE 0 END) as correct')
            ->groupBy('category')
            ->get();

        $stats = $rows->map(fn ($row) => [
            'category' => $row->category,
            'total' => (int) $row->total,
            'correct' => (int) $row->correct,
            'accuracy' => $row->total > 0 ? (int) round(($row->correct / $row->total) * 100) : 0,
        ])->sortBy('accuracy')->values()->all();

        return $stats;
    }

    private function normalizeFillAnswer(string $answer): string
    {
        $answer = mb_strtolower(trim($answer));
        $answer = trim($answer, " \t\n\r\0\x0B.,;:!?");

        return preg_replace('/\s+/', ' ', $answer);
    }

    private function isLevelUnlocked(int $materiId, string $level, array $quizLevels): bool
    {
        $levelOrder = MateriCatalog::levelOrder();
        $index = array_search($level, $levelOrder, true);

        if ($index === false || $index === 0) {
            return true; // first level is always open
        }

        $previousKey = $levelOrder[$index - 1];
        $previousLevel = $quizLevels[$previousKey] ?? null;
        if (! $previousLevel) {
            return true;
        }

        $passScore = $previousLevel['passScore'];
        if ($passScore === null) {
            return true;
        }

        $attempts = QuizAttempt::where('materi_id', $materiId)->where('level', $previousKey)->get();
        $bestAttempt = $this->bestAttemptByPercentage($attempts);

        if (! $bestAttempt || $bestAttempt->total === 0) {
            return false;
        }

        return ($bestAttempt->score / $bestAttempt->total) >= $passScore;
    }

    /**
     * @param  \Illuminate\Support\Collection<int, QuizAttempt>  $attempts
     */
    private function bestAttemptByPercentage($attempts): ?QuizAttempt
    {
        return $attempts
            ->sortByDesc(fn (QuizAttempt $a) => $a->total > 0 ? $a->score / $a->total : 0)
            ->first();
    }
}
