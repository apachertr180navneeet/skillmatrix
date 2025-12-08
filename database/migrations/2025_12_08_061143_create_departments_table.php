<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();                                       // Primary key
            $table->string('department_name');                  // Department name
            $table->enum('status', ['active','inactive'])->default('active'); // Status field
            $table->softDeletes();                              // deleted_at for soft delete
            $table->timestamps();                               // created_at , updated_at
        });
    }

    public function down()
    {
        Schema::dropIfExists('departments');
    }
};


