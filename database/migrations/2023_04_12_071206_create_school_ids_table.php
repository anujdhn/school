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
        Schema::create('school_ids', function (Blueprint $table) {
            $table->id();
            $table->string('school_id')->unique();
            $table->string('school_name');
            $table->string('mobile_no');
            $table->string('email');
            $table->string('password');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('address');
            $table->integer('pincode');
            $table->tinyInteger('is_active')->default('1');
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('school_ids');
    }
};
