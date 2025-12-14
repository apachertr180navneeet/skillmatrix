<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();

            $table->date('date');
            $table->string('plan_name');   // plan_name (fixed spelling)
            $table->unsignedBigInteger('party_id');
            $table->decimal('amount', 10, 2);
            $table->string('utr_id')->nullable();

            $table->timestamps();
            $table->softDeletes(); // for soft delete
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('payments');
    }
};
