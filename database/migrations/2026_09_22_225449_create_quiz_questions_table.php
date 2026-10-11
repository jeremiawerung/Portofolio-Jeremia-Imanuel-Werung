<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('quiz_questions', function (Blueprint $table) {
            $table->id();
            $table->unsignedInteger('materi_id');
            $table->string('level');
            $table->string('category');
            $table->string('type'); // mc | fill
            $table->text('question');
            $table->json('options')->nullable(); // mc only
            $table->unsignedInteger('correct')->nullable(); // mc only: index into options
            $table->json('accepted')->nullable(); // fill only: normalized accepted answers
            $table->text('explain');
            $table->timestamps();

            $table->index(['materi_id', 'level']);
            $table->index('category');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('quiz_questions');
    }
};
