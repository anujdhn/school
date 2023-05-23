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
        Schema::create('fee_head_types', function (Blueprint $table) {
            $table->id();
            $table->string('fee_head_type')->unique();
            $table->integer('is_annual');
            $table->integer('is_optional');
            $table->integer('is_latefee_applicable');
            $table->string('academic_year');
            $table->string('school_id');           
            $table->string('created_by');
            $table->string('ip_address');
            $table->integer('version_no')->default(0);
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fee_head_types');
    }
};
