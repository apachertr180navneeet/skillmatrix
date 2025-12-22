<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videouserresult', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('vedio_id');
            $table->unsignedBigInteger('user_id');

            // Result percentage or score
            $table->integer('result')->default(0);

            // pass / fail
            $table->enum('result_status', ['pass', 'fail'])->default('fail');

            $table->integer('total_questions')->default(0);
            $table->integer('correct_answers')->default(0);
            $table->integer('wrong_answers')->default(0);

            $table->timestamps();
            $table->softDeletes();

            // Optional indexes
            $table->index(['vedio_id', 'user_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videouserresult');
    }
};
