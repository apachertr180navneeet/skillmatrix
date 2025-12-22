<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sopuserresults', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sop_id');
            $table->unsignedBigInteger('user_id');
            $table->integer('result')->nullable();
            $table->integer('total_questions')->nullable();
            $table->integer('correct_answers')->nullable();
            $table->integer('wrong_answers')->nullable();

            $table->enum('result_status', ['pass', 'fail']);

            $table->timestamps();
            $table->softDeletes();

            // Optional foreign keys (enable if needed)
            // $table->foreign('sop_id')->references('id')->on('sops')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sopuserresults');
    }
};
