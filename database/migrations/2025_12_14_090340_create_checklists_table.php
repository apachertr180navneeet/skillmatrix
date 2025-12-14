<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('checklists', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('party_id');
            $table->unsignedBigInteger('department_id');

            $table->string('title');
            $table->text('description')->nullable();
            $table->string('file')->nullable();

            // created_at default current timestamp
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // updated_at nullable
            $table->timestamp('updated_at')->nullable();

            // soft delete
            $table->softDeletes();

            // optional foreign keys
            // $table->foreign('party_id')->references('id')->on('parties')->onDelete('cascade');
            // $table->foreign('department_id')->references('id')->on('departments')->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('checklists');
    }
};
