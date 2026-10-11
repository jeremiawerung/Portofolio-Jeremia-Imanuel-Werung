<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizQuestion extends Model
{
    protected $fillable = [
        'materi_id',
        'level',
        'category',
        'type',
        'question',
        'options',
        'correct',
        'accepted',
        'explain',
    ];

    protected $casts = [
        'options' => 'array',
        'accepted' => 'array',
    ];
}
