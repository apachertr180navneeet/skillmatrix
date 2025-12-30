<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('checklist_ques_ans', function (Blueprint $table) {
            $table->id();

            // 🔗 Checklist relation
            $table->unsignedBigInteger('checklist_id');

            // Question
            $table->text('question');

            // Options
            $table->string('option_one')->nullable();
            $table->string('option_two')->nullable();
            $table->string('option_three')->nullable();
            $table->string('option_four')->nullable();

            // Selected answer option
            // example: option_one / option_two
            $table->string('answer_option');

            // timestamps
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->nullable();

            // soft delete
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklist_ques_ans');
    }
};

