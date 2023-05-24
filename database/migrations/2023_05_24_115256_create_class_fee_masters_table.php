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
        Schema::create('class_fee_masters', function (Blueprint $table) {
            $table->id();
            $table->integer('class_id');
            $table->integer('fee_head_id');
            $table->integer('fee_amount');
            $table->integer('discount');
            $table->integer('net_fee');
            $table->integer('levied_in_jan');
            $table->integer('levied_in_feb');
            $table->integer('levied_in_mar');
            $table->integer('levied_in_apr');
            $table->integer('levied_in_may');
            $table->integer('levied_in_jun');
            $table->integer('levied_in_jul');
            $table->integer('levied_in_aug');
            $table->integer('levied_in_sep');
            $table->integer('levied_in_oct');
            $table->integer('levied_in_nov');
            $table->integer('levied_in_dec');
            $table->string('academic_year')->nullable();                //common for all table
            $table->bigInteger('school_id')->nullable();                //common for all table         
            $table->bigInteger('created_by')->nullable();               //common for all table   
            $table->string('ip_address');                   //common for all table   
            $table->integer('version_no')->default(0);      //common for all table   
            $table->smallInteger('status')->default(1);     //1-Active, 2-Not Active
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('class_fee_masters');
    }
};
