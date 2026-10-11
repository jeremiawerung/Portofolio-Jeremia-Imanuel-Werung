<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PageView extends Model
{
    public const UPDATED_AT = null;

    protected $fillable = [
        'path',
        'referrer_host',
        'visitor_hash',
        'new_visit',
    ];

    protected function casts(): array
    {
        return [
            'new_visit' => 'boolean',
            'created_at' => 'datetime',
        ];
    }
}
