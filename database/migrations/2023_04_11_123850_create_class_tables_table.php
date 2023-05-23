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
        // Schema::create('class_tables', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('class_name')->unique();
        //     $table->string('class_name_display')->unique();
        //     $table->integer('is_deleted')->default(0);
        //     $table->timestamps();
        // });
        Schema::create('class_tables', function (Blueprint $table) {
            $table->id();
            $table->integer('class_name');
            $table->string('class_name_display');
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
        Schema::dropIfExists('class_tables');
    }
};
