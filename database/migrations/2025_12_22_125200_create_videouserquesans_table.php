<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videouserquesans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vedio_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ques_id');

            // Answer selected by user (1,2,3,4)
            $table->enum('answere', ['1', '2', '3', '4'])->nullable();

            $table->timestamps();
            $table->softDeletes();

            // Optional indexes
            $table->index(['vedio_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videouserquesans');
    }
};
