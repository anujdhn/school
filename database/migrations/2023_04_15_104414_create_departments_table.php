<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('department_name');
            $table->string('abbreviation_name');
            $table->string('created_by');
            $table->string('ip_address');
            $table->string('school_id');
            $table->string('academic_year');
            $table->integer('version_no')->default(0); 
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
        // Schema::create('departments', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('department_name')->unique();
        //     $table->string('abbreviation_name')->nullable();
        //     $table->string('created_by');
        //     $table->integer('is_deleted')->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
