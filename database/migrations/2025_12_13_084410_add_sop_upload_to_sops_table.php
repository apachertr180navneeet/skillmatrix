<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('sop', function (Blueprint $table) {
            $table->string('sop_upload')->nullable()->after('title');
        });
    }

    public function down(): void
    {
        Schema::table('sop', function (Blueprint $table) {
            $table->dropColumn('sop_upload');
        });
    }
};

