<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class QuizAttempt extends Model
{
    protected $fillable = [
        'materi_id',
        'level',
        'answers',
        'score',
        'total',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    public function answerLogs(): HasMany
    {
        return $this->hasMany(QuizAttemptAnswer::class);
    }

    public function percentage(): int
    {
        return $this->total > 0 ? (int) round(($this->score / $this->total) * 100) : 0;
    }
}
