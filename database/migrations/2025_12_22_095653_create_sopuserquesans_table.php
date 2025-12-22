<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('sopuserquesans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sop_id');
            $table->unsignedBigInteger('user_id');
            $table->unsignedBigInteger('ques_id');
            $table->enum('answere', ['0', '1', '2', '3', '4'])->default('0')->comment('0 = not answered');

            $table->timestamps();
            $table->softDeletes();

            /*
            |------------------------------
            | Foreign Keys (Optional but Recommended)
            |------------------------------
            */
            // $table->foreign('sop_id')->references('id')->on('sops')->onDelete('cascade');
            // $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            // $table->foreign('ques_id')->references('id')->on('sop_questions')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sopuserquesans');
    }
};
