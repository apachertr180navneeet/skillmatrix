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
        Schema::create('vedio_quesans', function (Blueprint $table) {
            $table->id();
            // Foreign key reference (video)
            $table->unsignedBigInteger('vedio_id');

            // Question & options
            $table->text('question');
            $table->string('option_one');
            $table->string('option_two');
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();

            // Correct answer (option_one | option_two | etc.)
            $table->string('answere_option');

            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vedio_quesans');
    }
};
