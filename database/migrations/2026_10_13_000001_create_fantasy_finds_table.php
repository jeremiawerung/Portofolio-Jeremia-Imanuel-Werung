<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        // Pengunjung yang nemu mode rahasia "My Fantasy Mode" (buat penghitung di Dashboard)
        Schema::create('fantasy_finds', function (Blueprint $table) {
            $table->id();
            // hash IP + browser, IP aslinya gak disimpen. Unik biar 1 orang dihitung sekali.
            $table->char('visitor_hash', 64)->unique();
            $table->timestamp('created_at')->useCurrent();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('fantasy_finds');
    }
};
