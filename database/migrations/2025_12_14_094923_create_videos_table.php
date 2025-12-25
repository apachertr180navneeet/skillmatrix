<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();

            $table->string('title');
            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('department_id');
            $table->string('video_file')->nullable();
            $table->text('description')->nullable();
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_suggestion', ['0', '1'])->default('0');
            // created_at default current timestamp
            $table->timestamp('created_at')->useCurrent();

            // soft delete
            $table->softDeletes();

            // Optional: foreign keys (remove if not needed)
            // $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};
