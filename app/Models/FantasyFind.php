<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FantasyFind extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'visitor_hash',
    ];

    protected function casts(): array
    {
        return [
            'created_at' => 'datetime',
        ];
    }
}
