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
        Schema::create('fee_heads', function (Blueprint $table) {
            $table->id();
            $table->integer('school_id');
            $table->string('fee_head_name')->unique();
            $table->string('fee_head_c_name')->nullable();
            $table->integer('fee_code');
            $table->string('fee_description');
            $table->string('academic_year');
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
        Schema::dropIfExists('fee_heads');
    }
};
