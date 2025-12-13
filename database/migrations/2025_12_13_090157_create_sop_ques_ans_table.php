<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sop_ques_ans', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('sop_id');

            $table->text('question');

            $table->string('option_one')->nullable();
            $table->string('option_two')->nullable();
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();

            $table->string('answere_option'); // ex: option_one / option_two

            // created_at default current timestamp
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // optional updated_at
            $table->timestamp('updated_at')->nullable();

            // soft delete column
            $table->softDeletes();

            // optional foreign key (if sop table exists)
            // $table->foreign('sop_id')->references('id')->on('sops')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sop_ques_ans');
    }
};
