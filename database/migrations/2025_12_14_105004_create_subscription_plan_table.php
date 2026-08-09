<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subscription_plan', function (Blueprint $table) {
            $table->id();

            $table->string('plan_name');
            $table->decimal('amount', 10, 2);
            $table->enum('status', ['active', 'inactive'])->default('active');

            // created_at with current timestamp
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));

            // soft delete column
            $table->softDeletes();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subscription_plan');
    }
};
