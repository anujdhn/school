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
        Schema::create('sections', function (Blueprint $table) {
            $table->id();
            $table->string('section_name');
            $table->string('created_by',100);
            $table->string('ip_address');
            $table->integer('version_no')->default(0); 
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
        // Schema::create('sections', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('section_name')->unique();
        //     $table->integer('is_deleted')->default(0);
        //     $table->timestamps();
        // });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sections');
    }
};
