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
            $table->string('fee_head_type');
            $table->integer('is_annual');
            $table->integer('is_optional');
            $table->integer('is_latefee_applicable');
            $table->string('academic_year');            //common for all table
            $table->string('school_id');                //common for all table         
            $table->string('created_by');               //common for all table   
            $table->string('ip_address');               //common for all table   
            $table->integer('version_no')->default(0);  //common for all table   
            $table->integer('status')->default(1);      //1-Active, 2-Not Active
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
