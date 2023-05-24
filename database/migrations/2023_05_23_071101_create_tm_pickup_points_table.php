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
        Schema::create('tm_pickup_points', function (Blueprint $table) {
            $table->id();
            $table->string('pickup_point_name');
            $table->string('pickup_point_address');
            $table->string('school_id')->nullable();
            $table->string('ip_address');
            $table->string('academic_year')->nullable();
            $table->string('created_by')->nullable();
            $table->smallInteger('is_deleted')->default(0);
            $table->smallInteger('is_active')->default(1); 
            $table->smallInteger('version_no')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tm_pickup_points');
    }
};
