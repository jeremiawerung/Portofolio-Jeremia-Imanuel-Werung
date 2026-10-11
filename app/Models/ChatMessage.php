<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatMessage extends Model
{
    // is_author sama ip_hash sengaja gak di sini, diisi manual di controller
    protected $fillable = [
        'name',
        'message',
    ];

    protected $hidden = [
        'ip_hash',
    ];

    protected function casts(): array
    {
        return [
            'is_author' => 'boolean',
        ];
    }

    /**
     * Bentuk data yang dikirim ke browser. Gak ada IP atau data lain.
     */
    public function toPublicArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'message' => $this->message,
            'is_author' => $this->is_author,
            'created_at' => $this->created_at?->toIso8601String(),
        ];
    }
}
