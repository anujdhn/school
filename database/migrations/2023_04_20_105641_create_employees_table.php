<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * version_no : 0 -> for add initial, 1 and so on -> for no of change
     */
    public function up(): void
    {
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->string('emp_no');
            $table->integer('salutation_id');
            $table->string('salutation_name');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->nullable();
            $table->bigInteger('mobile');
            $table->date('dob');
            $table->date('doj');
            $table->bigInteger('aadhar_no');
            $table->string('disability');
            $table->integer('gender_id');
            $table->string('gender_name');
            $table->integer('category_id');
            $table->string('category_name');
            $table->integer('blood_group_id');
            $table->string('blood_group_name');
            $table->integer('department_id');
            $table->string('department_name');
            $table->integer('employee_type_id');
            $table->string('employee_type_name');
            $table->integer('teaching_title_id');
            $table->string('teaching_title_name');
            $table->integer('marital_status_id');
            $table->string('marital_status_name');
            $table->string('upload_image')->nullable();            
            $table->string('p_address1')->nullable();
            $table->string('p_address2')->nullable();
            $table->string('p_locality')->nullable();
            $table->string('p_landmark')->nullable();
            $table->integer('p_country_id')->nullable();
            $table->string('p_country_name')->nullable();
            $table->integer('p_state_id')->nullable();
            $table->string('p_state_name')->nullable();
            $table->string('p_district_id')->nullable();
            $table->string('p_district_name')->nullable();
            $table->integer('p_pincode')->nullable();            
            $table->string('c_address1')->nullable();
            $table->string('c_address2')->nullable();
            $table->string('c_locality')->nullable();
            $table->string('c_landmark')->nullable();
            $table->integer('c_country_id')->nullable();
            $table->string('c_country_name')->nullable();
            $table->integer('c_state_id')->nullable();
            $table->string('c_state_name')->nullable();
            $table->string('c_district_id')->nullable();
            $table->string('c_district_name')->nullable();
            $table->integer('c_pincode')->nullable();
            $table->string('fathers_name')->nullable();
            $table->integer('fathers_qualification_id')->nullable();
            $table->string('fathers_qualification_name')->nullable();
            $table->integer('fathers_occupation_id')->nullable();
            $table->string('fathers_occupation_name')->nullable();
            $table->string('fathers_annual_income')->nullable();
            $table->string('mothers_name')->nullable();
            $table->integer('mothers_qualification_id')->nullable();
            $table->string('mothers_qualification_name')->nullable();
            $table->integer('mothers_occupation_id')->nullable();
            $table->string('mothers_occupation_name')->nullable();
            $table->string('mothers_annual_income')->nullable();      
            $table->integer('bank_id')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_no')->nullable();
            $table->string('account_type')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('branch_name')->nullable();
            $table->string('nominee_name')->nullable();
            $table->string('nominee_relation_id')->nullable();
            $table->string('nominee_relation_name')->nullable();
            $table->string('pan_no')->nullable();
            $table->string('epf_no')->nullable();
            $table->string('uan_no')->nullable();
            $table->string('esi_no')->nullable();
            $table->string('nps_no')->nullable();
            $table->string('created_by')->nullable();
            $table->string('school_id')->nullable();
            $table->smallInteger('is_deleted')->default(0);
            $table->smallInteger('is_active')->default(1); 
            $table->string('ip_address');
            $table->smallInteger('version_no')->default(0); //version_no: 0->initially added, 1 and so on->no of change           
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
