<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subscription_plan', function (Blueprint $table) {
            $table->integer('duration')
                  ->comment('Duration in days')
                  ->after('amount');

            $table->integer('user')
                  ->comment('Number of users allowed')
                  ->after('duration');
        });
    }

    public function down(): void
    {
        Schema::table('subscription_plan', function (Blueprint $table) {
            $table->dropColumn(['duration', 'user']);
        });
    }
};

