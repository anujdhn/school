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
            $table->integer('fee_head_type_id');
            $table->string('fee_head');
            $table->string('description');
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
        Schema::dropIfExists('fee_heads');
    }
};
