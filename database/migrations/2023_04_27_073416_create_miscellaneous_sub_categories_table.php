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
        Schema::create('miscellaneous_sub_categories', function (Blueprint $table) {
            $table->id();
            $table->integer('misc_category_id');
            $table->string('misc_sub_category_name');
            $table->string('remark_1')->nullable();
            $table->string('remark_2')->nullable();
            $table->integer('is_deleted')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('miscellaneous_sub_categories');
    }
};
