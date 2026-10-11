<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Analytics bikinan sendiri. IP gak disimpen mentah: yang disimpen cuma
     * hash harian (IP + browser + tanggal + APP_KEY), jadi gak bisa dilacak balik.
     */
    public function up(): void
    {
        Schema::create('page_views', function (Blueprint $table) {
            $table->id();
            $table->string('path', 255);
            $table->string('referrer_host', 100)->nullable();
            $table->char('visitor_hash', 64);
            $table->boolean('new_visit')->default(true);
            $table->timestamp('created_at')->useCurrent();

            $table->index('created_at');
            $table->index(['visitor_hash', 'created_at']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_views');
    }
};
