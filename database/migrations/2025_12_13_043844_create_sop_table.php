<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('sop', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('department_id');
            $table->unsignedBigInteger('party_id');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->enum('is_suggestion', ['0', '1'])->default('0');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sop');
    }
};
