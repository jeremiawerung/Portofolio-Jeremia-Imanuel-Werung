<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chat_messages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 40);
            $table->string('message', 500);
            // true kalau yang ngirim admin (Jeremia) lagi login, buat badge "Author"
            $table->boolean('is_author')->default(false);
            // hash IP, cuma dipakai buat nahan spam pesan dobel
            $table->char('ip_hash', 64);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chat_messages');
    }
};
