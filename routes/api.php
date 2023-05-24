<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\Admin\UserController;
use App\Http\Controllers\API\Admin\PasswordResetController;
use App\Http\Controllers\API\Master\MasterController;
use App\Http\Controllers\API\Employee\EmployeeController;
use App\Http\Controllers\API\FeeStructure\FeeController;
use App\Http\Controllers\API\Transport\TransportController;
use App\Http\Controllers\API\Student\StudentController;

use App\Http\Controllers\CategoryController;

/*================================================== API Routes ==================================================
Created By : Lakshmi kumari 
Created On : 01-Apr-2023 
Code Status : Open 
*/


//Admin : Public Routes : 
Route::controller(UserController::class)->group(function() {
    Route::post('/register', 'register')->name('reg'); //Register -------------------------------------- API_ID_1
    Route::post('/login', 'login'); //Login ------------------------------------------------------------ API_ID_2    
});

Route::controller(PasswordResetController::class)->group(function() {
    Route::post('/sendResetPasswordEmail','sendResetPasswordEmail'); // Send Reset Password ------------ API_ID_3
    Route::post('/resetPassword/{token}','resetPassword'); // Reset Password --------------------------- API_ID_4  
});

//Admin : Protected Routes 
Route::middleware('auth:sanctum')->group(function () {
    Route::controller(UserController::class)->group(function() {
        Route::get('/profile','profile'); //View Profile ----------------------------------------------- API_ID_5
        Route::post('/editProfile','editProfile'); //Edit Profile Using ID ----------------------------- API_ID_6
        Route::post('/logout','logout'); //Logout ------------------------------------------------------ API_ID_7
        Route::post('/changePassword','changePassword'); //Change Password ----------------------------- API_ID_8
        Route::post('/deleteProfile','deleteProfile'); //Delete Profile -------------------------------- API_ID_9
    });        
});

//Master : Public Routes 
Route::controller(MasterController::class)->group(function() {
    Route::post('/add_class','addClassTable'); //Add Class --------------------------------------------- API_ID_10
    Route::post('/view_class','viewClassTable'); // View Class ------------------------------------------ API_ID_11
    Route::post('/view_class_by_id','viewClassTableById'); //View Class By ID -------------------------- API_ID_12
    Route::post('/edit_class','editClassTable'); //Edit Class ------------------------------------------ API_ID_13
    Route::post('/delete_class','deleteClassTableById');//Delete Class --------------------------------- API_ID_14
    Route::delete('/delete_all_class/','deleteAllClassTable');//Delete All Class ----------------------- API_ID_15

    Route::post('/add_subject','addSubject'); //Add Subject -------------------------------------------- API_ID_16
    Route::get('/view_subject','viewSubject'); //View Subject ------------------------------------------ API_ID_17
    Route::post('/view_subject_by_id','viewSubjectById'); //View Subject By ID ------------------------- API_ID_18
    Route::post('/edit_subject','editSubject'); //Edit Subject ----------------------------------------- API_ID_19
    Route::post('/delete_subject','deleteSubjectById'); //Delete Subject By ID ------------------------- API_ID_20
    Route::delete('/delete_all_subject','deleteAllSubject'); //Delete All Subject ---------------------- API_ID_21

    Route::post('/add_section','addSection'); //Add Section  ------------------------------------------- API_ID_22
    Route::get('/view_section','viewSection'); //View Section ------------------------------------------ API_ID_23
    Route::post('/view_section_by_id','viewSectionById'); //View Section By ID ------------------------- API_ID_24
    Route::post('/edit_section','editSection'); //Edit Section ----------------------------------------- API_ID_25
    Route::post('/delete_section','deleteSectionById'); //Delete Section By ID ------------------------- API_ID_26
    Route::delete('/delete_all_section','deleteAllSection'); //Delete All Section ---------------------- API_ID_27

    Route::post('/add_designation','addDesignation'); //Add Designation -------------------------------- API_ID_28
    Route::get('/view_designation','viewDesignation'); //View Designation ------------------------------ API_ID_29
    Route::post('/view_designation_by_id','viewDesignationById'); //view Designation By ID ------------- API_ID_30
    Route::post('/edit_designation','editDesignation'); // Edit Designation ---------------------------- API_ID_31
    Route::post('/delete_designation','deleteDesignationById'); //Delete Designation ------------------- API_ID_32
    Route::delete('/delete_all_designation','deleteAllDesignation'); //Delete All Designation ---------- API_ID_33

    Route::post('/add_board','addBoard'); //Add Board -------------------------------------------------- API_ID_34
    Route::get('/view_board','viewBoard'); //View Board ------------------------------------------------ API_ID_35
    Route::post('/view_board_by_id','viewBoardById'); //View Board By ID ------------------------------- API_ID_36
    Route::post('/edit_board','editBoard'); //Edit Board ----------------------------------------------- API_ID_37
    Route::post('/delete_board','deleteBoardById'); //Delete Board By ID ------------------------------- API_ID_38
    Route::delete('/delete_all_board','deleteAllBoard'); //Delete All Board ---------------------------- API_ID_39

    Route::post('/add_caste','addCaste'); //Add Class -------------------------------------------------- API_ID_40
    Route::get('/view_caste','viewCaste'); //View Caste ------------------------------------------------ API_ID_41
    Route::post('/view_caste_by_id','viewCasteById'); //View Caste By ID ------------------------------- API_ID_42
    Route::post('/edit_caste','editCaste'); //Edit Caste ----------------------------------------------- API_ID_43
    Route::post('/delete_caste','deleteCasteById'); //Delete Caste By ID ------------------------------- API_ID_44
    Route::delete('/delete_all_caste','deleteAllCaste'); //Delete All Caste ---------------------------- API_ID_45

    Route::post('/add_attendance','addAttendance'); //Add Attendance ----------------------------------- API_ID_46
    Route::get('/view_attendance','viewAttendance'); //View Attendance --------------------------------- API_ID_47
    Route::post('/view_attendance_by_id','viewAttendanceById'); //View Attendance By ID ---------------- API_ID_48
    Route::post('/edit_attendance','editAttendance'); //Edit Attendance -------------------------------- API_ID_49
    Route::post('/delete_attendance','deleteAttendanceById'); //Delete Attendance By ID ---------------- API_ID_50
    Route::delete('/delete_all_attendance','deleteAllAttendance'); //Delete All Attendance  ------------ API_ID_51

    Route::post('/add_certificate','addCertificate'); //Add Certificate -------------------------------- API_ID_52
    Route::get('/view_certificate','viewCertificate'); //View Certificate  ----------------------------- API_ID_53
    Route::post('/view_certificate_by_id','viewCertificateById'); //View Certificate By ID ------------- API_ID_54
    Route::post('/edit_certificate','editCertificate'); //Edit Certificate ----------------------------- API_ID_55
    Route::post('/delete_certificate','deleteCertificateById'); //Delete Certificate By ID ------------- API_ID_56
    Route::delete('/delete_all_certificate','deleteAllCertificate'); //Delete All Certificate ---------- API_ID_57

    Route::post('/add_fy','addFinancialYear'); //Add Financial Year ------------------------------------ API_ID_58
    Route::get('/view_fy','viewFinancialYear'); //View Financial Year ---------------------------------- API_ID_59
    Route::post('/view_fy_by_id','viewFinancialYearById'); //View Financial Year By ID ----------------- API_ID_60
    Route::post('/edit_fy','editFinancialYear'); //Edit Financial Year --------------------------------- API_ID_61
    Route::post('/delete_fy','deleteFinancialYearById'); //Delete Financial Year By ID ----------------- API_ID_62
    Route::delete('/delete_all_fy','deleteAllFinancialYear'); //Delete All Financial Year -------------- API_ID_63
    
    Route::post('/add_installment','addInstallment'); //Add Installment -------------------------------- API_ID_64
    Route::get('/view_installment','viewInstallment'); //View Installment ------------------------------ API_ID_65
    Route::post('/view_installment_by_id','viewInstallmentById'); //View Installment By ID ------------- API_ID_66
    Route::post('/edit_installment','editInstallment'); //Edit Installment ----------------------------- API_ID_67
    Route::post('/delete_installment','deleteInstallmentById'); //Delete Installment By ID ------------- API_ID_68
    Route::delete('/delete_all_installment','deleteAllInstallment'); //Delete All Installment ---------- API_ID_69

    Route::post('/add_leave','addLeave'); //Add Leave -------------------------------------------------- API_ID_70
    Route::get('/view_leave','viewLeave'); //View Leave  ----------------------------------------------- API_ID_71
    Route::post('/view_leave_by_id','viewLeaveById'); //View Leave By ID ------------------------------- API_ID_72
    Route::post('/edit_leave','editLeave'); //Edit Leave ----------------------------------------------- API_ID_73
    Route::post('/delete_leave','deleteLeaveById'); //Delete Leave ------------------------------------- API_ID_74
    Route::delete('/delete_all_leave','deleteAllLeave'); //Delete All Leave By ID ---------------------- API_ID_75
    
    Route::post('/add_role','addRole'); //Add Role ----------------------------------------------------- API_ID_76
    Route::get('/view_role','viewRole'); //View Role --------------------------------------------------- API_ID_77
    Route::post('/view_role_by_id','viewRoleById'); //View Role By ID ---------------------------------- API_ID_78
    Route::post('/edit_role','editRole'); //Edit Role -------------------------------------------------- API_ID_79
    Route::post('/delete_role','deleteRoleById'); //Delete Role By ID ---------------------------------- API_ID_80
    Route::delete('/delete_all_role','deleteAllRole'); //Delete All Role ------------------------------- API_ID_81

    Route::post('/add_sport','addSport'); //Add Sport -------------------------------------------------- API_ID_82
    Route::get('/view_sport','viewSport'); //View Sport ------------------------------------------------ API_ID_83
    Route::post('/view_sport_by_id','viewSportById'); //View Sport By ID ------------------------------- API_ID_84
    Route::post('/edit_sport','editSport'); //Edit Sport ----------------------------------------------- API_ID_85
    Route::post('/delete_sport','deleteSportById'); //Delete Sport By ID ------------------------------- API_ID_86
    Route::delete('/delete_all_sport','deleteAllSport'); //Delete All Sport ---------------------------- API_ID_87

    Route::post('/add_timeTable','addTimeTable'); //Add Time Table ------------------------------------- API_ID_88
    Route::get('/view_timeTable','viewTimeTable'); //View Time Table ----------------------------------- API_ID_89
    Route::post('/view_timeTable_by_id','viewTimeTableById'); //View Time Table By ID ------------------ API_ID_90
    Route::post('/edit_timeTable','editTimeTable'); //Edit Time Table ---------------------------------- API_ID_91
    Route::post('/delete_timeTable','deleteTimeTableById'); //Delete Time Table By ID ------------------ API_ID_92
    Route::delete('/delete_all_timeTable','deleteAllTimeTable'); //Delete All Time Table --------------- API_ID_93
    
    Route::post('/add_schoolId','addSchoolId'); //Add School Id ---------------------------------------- API_ID_94
    Route::get('/view_schoolId','viewSchoolId'); //View School Id -------------------------------------- API_ID_95
    Route::post('/view_schoolId_by_id','viewSchoolIdById'); //View School Id BY ID --------------------- API_ID_96
    Route::post('/edit_schoolId','editSchoolId'); //Edit School Id ------------------------------------- API_ID_97
    Route::post('/delete_schoolId','deleteSchoolIdById'); //Delete School Id By ID --------------------- API_ID_98
    Route::delete('/delete_all_schoolId','deleteAllSchoolId'); //Delete All School Id ------------------ API_ID_99

    Route::post('/add_module','addModule'); //Add Module ----------------------------------------------- API_ID_100
    Route::get('/view_module','viewModule'); //View Module --------------------------------------------- API_ID_101
    Route::post('/view_module_by_id','viewModuleById'); //View Module BY ID ---------------------------- API_ID_102
    Route::post('/edit_module','editModule'); //Edit Module -------------------------------------------- API_ID_103 
    Route::post('/delete_module','deleteModuleById'); //Delete Module By ID ---------------------------- API_ID_104
    Route::delete('/delete_all_module','deleteAllModule'); //Delete All Module ------------------------- API_ID_105

    Route::post('/add_sub_module','addSubModule'); //Add Sub Module ------------------------------------ API_ID_106
    Route::get('/view_sub_module','viewSubModule'); //View Sub Module ---------------------------------- API_ID_107
    Route::post('/view_sub_module_by_id','viewSubModuleById'); //View Sub Module BY ID ----------------- API_ID_108
    Route::post('/edit_sub_module','editSubModule'); //Edit Sub Module --------------------------------- API_ID_109
    Route::post('/delete_sub_module','deleteSubModuleById'); //Delete Sub Module By ID ----------------- API_ID_110
    Route::delete('/delete_all_sub_module','deleteAllSubModule'); //Delete All Sub Module -------------- API_ID_111

    Route::post('/add_course','addCourse'); //Add Course  ---------------------------------------------- API_ID_112
    Route::get('/view_course','viewCourse'); //View Course  -------------------------------------------- API_ID_113
    Route::post('/view_course_by_id','viewCourseById'); //View Course  BY ID --------------------------- API_ID_114
    Route::post('/edit_course','editCourse'); //Edit Course Module ------------------------------------- API_ID_115
    Route::post('/delete_course','deleteCourseById'); //Delete Course  By ID --------------------------- API_ID_116
    Route::delete('/delete_all_course','deleteAllCourse'); //Delete All Course  ------------------------ API_ID_117

    Route::post('/add_semester','addSemester'); //Add Semester  ---------------------------------------- API_ID_118
    Route::get('/view_semester','viewSemester'); //View Semester  -------------------------------------- API_ID_119
    Route::post('/view_semester_by_id','viewSemesterById'); //View Semester  BY ID --------------------- API_ID_120
    Route::post('/edit_semester','editSemester'); //Edit Semester Module ------------------------------- API_ID_121 
    Route::post('/delete_semester','deleteSemesterById'); //Delete Semester  By ID --------------------- API_ID_122
    Route::delete('/delete_all_semester','deleteAllSemester'); //Delete All Semester  ------------------ API_ID_123

    Route::post('/add_department','addDepartment'); //Add Department  ---------------------------------- API_ID_124
    Route::get('/view_department','viewDepartment'); //View Department  -------------------------------- API_ID_125
    Route::post('/view_department_by_id','viewDepartmentById'); //View Department  BY ID --------------- API_ID_126
    Route::post('/edit_department','editDepartment'); //Edit Department  ------------------------------- API_ID_127 
    Route::post('/delete_department','deleteDepartmentById'); //Delete Department  By ID --------------- API_ID_128
    Route::delete('/delete_all_department','deleteAllDepartment'); //Delete All Department ------------- API_ID_129

    Route::post('/add_institution','addInstitutionCode'); //Add Institution  --------------------------- API_ID_136
    Route::get('/view_institution','viewInstitutionCode'); //View Institution  ------------------------- API_ID_137
    Route::post('/view_institution_by_id','viewInstitutionCodeById'); //View Institution  BY ID--------- API_ID_138
    Route::post('/edit_institution','editInstitutionCode'); //Edit Institution  ------------------------ API_ID_139 
    Route::post('/delete_institution','deleteInstitutionCodeById'); //Delete Institution  By ID -------- API_ID_140
    Route::delete('/delete_all_institution','deleteAllInstitutionCode'); //Delete All Institution ------ API_ID_141

    Route::post('/add_perimssion','addPermission'); //Add Permission  ---------------------------------- API_ID_142
    Route::get('/view_perimssion','viewPermission'); //View Permission  -------------------------------- API_ID_143
    Route::post('/view_perimssion_by_id','viewPermissionById'); //View Permission  BY ID---------------- API_ID_144
    Route::post('/edit_perimssion','editPermission'); //Edit Permission  ------------------------------- API_ID_145 
    Route::post('/delete_perimssion','deletePermissionById'); //Delete Permission  By ID --------------- API_ID_146
    Route::delete('/delete_all_perimssion','deleteAllPermission'); //Delete All Permission ------------- API_ID_147

    Route::post('/add_misc_category','addMiscCategory'); //Add ----------------------------------------- API_ID_148
    Route::get('/view_misc_category','viewMiscCategory'); //View --------------------------------------- API_ID_149
    Route::post('/view_misc_category_by_id','viewMiscCategoryById'); //View BY ID----------------------- API_ID_150
    Route::post('/edit_misc_category','editMiscCategory'); //Edit -------------------------------------- API_ID_151 
    Route::post('/delete_misc_category','deleteMiscCategoryById'); //Del By ID ------------------------- API_ID_152
    Route::delete('/delete_all_misc_category','deleteAllMiscCategory'); //Del all----------------------- API_ID_153

    Route::post('/add_misc_sub_category','addMiscSubCategory'); //Add ---------------------------------- API_ID_154
    Route::get('/view_misc_sub_category','viewMiscSubCategory'); //View -------------------------------- API_ID_155
    Route::post('/view_misc_sub_category_by_id','viewMiscSubCategoryById'); //View BY ID---------------- API_ID_156
    Route::get('/view_misc_sub_category_by_name','viewMiscSubCategoryByName'); //View by name----------- API_ID_157
    // Route::post('/view_misc_sub_category_by_name','viewMiscSubCategoryByName'); //View by name------- API_ID_157
    Route::post('/edit_misc_sub_category','editMiscSubCategory'); //Edit ------------------------------- API_ID_158 
    Route::post('/delete_misc_sub_category','deleteMiscSubCategoryById'); //Del By ID ------------------ API_ID_159
    Route::delete('/delete_all_misc_sub_category','deleteAllMiscSubCategory'); //Del all---------------- API_ID_160

    Route::post('/add_emp_type','addEmpType'); //Add --------------------------------------------------- API_ID_161
    Route::get('/view_emp_type','viewEmpType'); //View ------------------------------------------------- API_ID_162
    Route::post('/view_emp_type_by_id','viewEmpTypeById'); //View BY ID--------------------------------- API_ID_163
    Route::post('/edit_emp_type','editEmpType'); //Edit ------------------------------------------------ API_ID_164 
    Route::post('/delete_emp_type','deleteEmpTypeById'); //Del By ID ----------------------------------- API_ID_165
    Route::delete('/delete_all_emp_type','deleteAllEmpType'); //Del all--------------------------------- API_ID_166
  
    Route::post('/add_teaching_type','addTeachingTitle'); //Add ---------------------------------------- API_ID_167
    Route::get('/view_teaching_type','viewTeachingTitle'); //View -------------------------------------- API_ID_168
    Route::post('/view_teaching_type_by_id','viewTeachingTitleById'); //View BY ID---------------------- API_ID_169
    Route::post('/edit_teaching_type','editTeachingTitle'); //Edit ------------------------------------- API_ID_170 
    Route::post('/delete_teaching_type','deleteTeachingTitleById'); //Del By ID ------------------------ API_ID_171
    Route::delete('/delete_all_teaching_type','deleteAllTeachingTitle'); //Del all---------------------- API_ID_172

    Route::post('/add_country','addCountry'); //Add  --------------------------------------------------- API_ID_173
    Route::get('/view_country','viewCountry'); // View  ------------------------------------------------ API_ID_174
    Route::post('/view_country_by_id','viewCountryById'); //View  By ID -------------------------------- API_ID_175
    Route::post('/edit_country','editCountry'); //Edit  ------------------------------------------------ API_ID_176
    Route::post('/delete_country','deleteCountryById');//Delete  --------------------------------------- API_ID_177
    Route::delete('/delete_all_country/','deleteAllCountry');//Delete All  ----------------------------- API_ID_178

    Route::post('/add_state','addState'); //Add  ------------------------------------------------------- API_ID_179
    Route::get('/view_state','viewState'); // View  ---------------------------------------------------- API_ID_180
    Route::post('/view_state_by_id','viewStateById'); //View By ID ------------------------------------- API_ID_181
    Route::post('/edit_state','editState'); //Edit ----------------------------------------------------- API_ID_182
    Route::post('/delete_state','deleteStateById');//Delete -------------------------------------------- API_ID_183
    Route::delete('/delete_all_state/','deleteAllState');//Delete All ---------------------------------- API_ID_184

    Route::post('/add_district','addDistrict'); //Add -------------------------------------------------- API_ID_185
    Route::get('/view_district','viewDistrict'); // View ----------------------------------------------- API_ID_186
    Route::post('/view_district_by_id','viewDistrictById'); //View By ID ------------------------------- API_ID_187
    Route::post('/edit_district','editDistrict'); //Edit ----------------------------------------------- API_ID_188
    Route::post('/delete_district','deleteDistrictById');//Delete -------------------------------------- API_ID_189
    Route::delete('/delete_all_district/','deleteAllDistrict');//Delete All -------- ------------------- API_ID_190

    Route::post('/add_bank','addBank'); //Add  --------------------------------------------------------- API_ID_191
    Route::get('/view_bank','viewBank'); // View  ------------------------------------------------------ API_ID_192
    Route::post('/view_bank_by_id','viewBankById'); //View By ID --------------------------------------- API_ID_193
    Route::post('/edit_bank','editBank'); //Edit  ------------------------------------------------------ API_ID_194
    Route::post('/delete_bank','deleteBankById');//Delete  --------------------------------------------- API_ID_195
    Route::delete('/delete_all_bank/','deleteAllBank');//Delete All  ----------------------------------- API_ID_196
   
});

Route::controller(EmployeeController::class)->group(function() {
    Route::post('/add_employee','addEmployee'); //Add  ------------------------------------------------- API_ID_130
    Route::get('/view_employee','viewEmployee'); //View ------------------------------------------------ API_ID_131
    Route::post('/view_employee_by_id','viewEmployeeById'); //View BY ID ------------------------------- API_ID_132
    Route::post('/edit_employee','editEmployee'); //Edit ----------------------------------------------- API_ID_133 
    Route::post('/delete_employee','deleteEmployeeById'); //Delete By ID ------------------------------- API_ID_134
    Route::delete('/delete_all_employee','deleteAllEmployee'); //Delete All ---------------------------- API_ID_135 
    Route::post('/search_employee_by_id','searchEmpByEmpId'); //search BY ID --------------------------- API_ID_197  
});

Route::controller(FeeController::class)->group(function () {
    Route::post('feehead-type/crud/store', 'store');
});

Route::controller(FeeController::class)->group(function(){

    Route::post('/add_feehead_type','postFeeHeadType');//Add -------------------------------------------- API_ID_235
    Route::post('/view_feehead_type','readFeeHeadType');//View ------------------------------------------ API_ID_236
    Route::post('/view_feehead_type_byId','getFeeHeadTypeById');//View By ID -------------------------- API_ID_237
    Route::post('/edit_feehead_type','editFeeHeadType');//Edit By ID -------------------------- -------- API_ID_238
    Route::post('/delete_feehead_type','deleteFeeHeadType');//Delete By ID -----------------------   --- API_ID_239
    
    Route::post('/add_fee_head','addFeeHead');//Add --------------------------------------------------- API_ID_198
    Route::get('/view_fee_head','viewFeeHead');//View ------------------------------------------------- API_ID_199
    Route::post('/view_fee_head_by_id','viewFeeHeadById');//View -------------------------------------- API_ID_200
    Route::post('/edit_fee_head','editFeeHead');//Edit By ID ------------------------------------------ API_ID_201
    Route::post('/delete_fee_head','deleteFeeHeadById');//Delete By ID -------------------------- API_ID_202
    Route::delete('/delete_all_fee_head/','deleteAllFeeHead');//Delete All Records -------------------- API_ID_203

    Route::post('/add_fee_master','addFeeMaster'); //Add  -------------------------------------------- API_ID_204
    Route::get('/view_fee_master','viewFeeMaster'); // View  ----------------------------------------- API_ID_205
    Route::post('/view_fee_master_by_id','viewFeeMasterById'); //View  By ID ------------------------- API_ID_206
    Route::post('/edit_fee_master','editFeeMaster'); //Edit  ----------------------------------------- API_ID_207
    Route::post('/delete_fee_master','deleteFeeMasterById');//Delete  -------------------------------- API_ID_208
    Route::delete('/delete_all_fee_master/','deleteAllFeeMaster');//Delete All Record ---------------- API_ID_209

    Route::post('/add_scholarship','addScholarship');//Add  ------------------------------------------ API_ID_210
    Route::get('/view_scholarship','viewScholarship');//View  ---------------------------------------- API_ID_211
    Route::post('/view_scholarship_by_id','viewScholarshipById');//View  By ID  ---------------------- API_ID_212
    Route::post('/edit_scholarship','editScholarship');//Edit  --------------------------------------- API_ID_213
    Route::post('/delete_scholarship_by_id','deleteScholarshipById');//Delete  ----------------------- API_ID_214
    Route::delete('/delete_all_scholarship/','deleteAllScholarship');//Delete All Record-------------- API_ID_215
});

Route::controller(TransportController::class)->group(function() {
    Route::post('/add_route','addRoute');//Add  ------------------------------------------------------ API_ID_216
    Route::get('/view_route','viewRoute');//View  ---------------------------------------------------- API_ID_217
    Route::post('/view_route_by_id','viewRouteById');//View  By ID  ---------------------------------- API_ID_218
    Route::post('/edit_route','editRoute');//Edit  --------------------------------------------------- API_ID_219
    Route::post('/delete_route','deleteRouteById');//Delete  ----------------------------------------- API_ID_220
    Route::delete('/delete_all_route/','deleteAllRoute');//Delete All Record-------------------------- API_ID_221 
    
    Route::post('/add_vehicle','addVehicle');//Add  ------------------------------------------------------ API_ID_229
    Route::get('/view_vehicle','viewVehicle');//View  ---------------------------------------------------- API_ID_230
    Route::post('/view_vehicle_by_id','viewVehicleById');//View  By ID  ---------------------------------- API_ID_231
    Route::post('/edit_vehicle','editVehicle');//Edit  --------------------------------------------------- API_ID_232
    Route::post('/delete_vehicle','deleteVehicleById');//Delete  ----------------------------------------- API_ID_233
    Route::delete('/delete_all_vehicle','deleteAllVehicle');//Delete All Record-------------------------- API_ID_234

    Route::post('/add_pickup_point','addPickupPoint'); //Add  ------------------------------------------------- API_ID_235
    Route::get('/view_pickup_point','viewPickupPoint');//View  ---------------------------------------------------- API_ID_236
    Route::post('/view_pickup_point_by_id','viewPickupPointById');//View  By ID  ---------------------------------- API_ID_237
    Route::post('/edit_pickup_point','editPickupPoint');//Edit  --------------------------------------------------- API_ID_238
    Route::post('/delete_pickup_point','deletePickupPointById');//Delete  ----------------------------------------- API_ID_239
    Route::delete('/delete_all_pickup_point','deleteAllPickupPoint');//Delete All Record-------------------------- API_ID_240
});

Route::controller(StudentController::class)->group(function() {
    Route::post('/add_student','addStudent'); //Add  ------------------------------------------------- API_ID_222
    Route::get('/view_student','viewStudent'); //View ------------------------------------------------ API_ID_223
    Route::post('/view_student_by_id','viewStudentById'); //View BY ID ------------------------------- API_ID_224
    Route::post('/edit_student','editStudent'); //Edit ----------------------------------------------- API_ID_225 
    Route::post('/delete_student','deleteStudentById'); //Delete By ID ------------------------------- API_ID_226
    Route::delete('/delete_all_student','deleteAllStudent'); //Delete All ---------------------------- API_ID_227 
    Route::post('/search_addmission_no','searchStdByAdmNo'); //search BY no -------------------------- API_ID_228  
});

//Routes for repository
Route::get('/category',[CategoryController::class, 'index']);
Route::post('/category',[CategoryController::class, 'store']); 

/*
    commentted By: Lakshmi
    Commentted On: 17-Apr-2023
    Description: Remove get, put and using post to send something from forms.

    //Admin : Public Routes : 
    Route::controller(UserController::class)->group(function() {
        Route::post('/register', 'register')->name('reg'); //API_ID_1 : Register
        Route::post('/login', 'login'); //API_ID_2 : Login    
    });

    Route::controller(PasswordResetController::class)->group(function() {
        Route::post('/sendResetPasswordEmail','sendResetPasswordEmail'); //API_ID_3 : Send Reset Password
        Route::post('/resetPassword/{token}','resetPassword'); //API_ID_4 : Reset Password   
    });

    //Admin : Protected Routes 
    Route::middleware('auth:sanctum')->group(function () {
        Route::controller(UserController::class)->group(function() {
            Route::get('/profile','profile'); //API_ID_5 : View Profile
            Route::put('/editProfile/{id}','editProfile'); //API_ID_6 : Edit Profile Using ID
            Route::post('/logout','logout'); //API_ID_7 : Logout
            Route::post('/changePassword','changePassword'); //API_ID_8 : Change Password
            Route::delete('/deleteProfile/{id}','deleteProfile'); //API_ID_9 : Delete Profile
        });        
    });

    //Master : Public Routes 
    Route::controller(MasterController::class)->group(function() {
        Route::post('/add_class','addClassTable'); //API_ID_10 : Add Class
        Route::get('/view_class','viewClassTable'); //API_ID_11 : View Class
        Route::get('/view_class/{id}','viewClassTableById'); //API_ID_12 : View Class By ID
        Route::put('/edit_class/{id}','editClassTable'); //API_ID_13 : Edit Class
        Route::delete('/delete_class/{id}','deleteClassTableById');//API_ID_14 : Delete Class
        Route::delete('/delete_all_class/','deleteAllClassTable');//API_ID_15 : Delete All Class

        Route::post('/add_subject','addSubject'); //API_ID_16 : Add Subject
        Route::get('/view_subject','viewSubject'); //API_ID_17 : View Subject
        Route::get('/view_subject/{id}','viewSubjectById'); //API_ID_18 : View Subject By ID
        Route::put('/edit_subject/{id}','editSubject'); //API_ID_19 : Edit Subject
        Route::delete('/delete_subject/{id}','deleteSubjectById'); //API_ID_20 : Delete Subject By ID
        Route::delete('/delete_all_subject','deleteAllSubject'); //API_ID_21 : Delete All Subject

        Route::post('/add_section','addSection'); //API_ID_22 : Add Section
        Route::get('/view_section','viewSection'); //API_ID_23 : View Section
        Route::get('/view_section/{id}','viewSectionById'); //API_ID_24 : View Section By ID
        Route::put('/edit_section/{id}','editSection'); //API_ID_25 : Edit Section
        Route::delete('/delete_section/{id}','deleteSectionById'); //API_ID_26 : Delete Section By ID
        Route::delete('/delete_all_section','deleteAllSection'); //API_ID_27 : Delete All Section

        Route::post('/add_designation','addDesignation'); //API_ID_28 : Add Designation
        Route::get('/view_designation','viewDesignation'); //API_ID_29 : View Designation
        Route::get('/view_designation/{id}','viewDesignationById'); //API_ID_30 : view Designation By ID
        Route::put('/edit_designation/{id}','editDesignation'); //API_ID_31 Edit : Designation
        Route::delete('/delete_designation/{id}','deleteDesignationById'); //API_ID_32 : Delete Designation
        Route::delete('/delete_all_designation','deleteAllDesignation'); //API_ID_33 : Delete All Designation

        Route::post('/add_board','addBoard'); //API_ID_34 : Add Board
        Route::get('/view_board','viewBoard'); //API_ID_35 : View Board
        Route::get('/view_board/{id}','viewBoardById'); //API_ID_36 : View Board By ID
        Route::put('/edit_board/{id}','editBoard'); //API_ID_37 : Edit Board
        Route::delete('/delete_board/{id}','deleteBoardById'); //API_ID_38 : Delete Board By ID
        Route::delete('/delete_all_board','deleteAllBoard'); //API_ID_39 : Delete All Board

        Route::post('/add_caste','addCaste'); //API_ID_40 : Add Class
        Route::get('/view_caste','viewCaste'); //API_ID_41 : View Caste
        Route::get('/view_caste/{id}','viewCasteById'); //API_ID_42 : View Caste By ID
        Route::put('/edit_caste/{id}','editCaste'); //API_ID_43 : Edit Caste
        Route::delete('/delete_caste/{id}','deleteCasteById'); //API_ID_44 : Delete Caste By ID
        Route::delete('/delete_all_caste','deleteAllCaste'); //API_ID_45 : Delete All Caste

        Route::post('/add_attendance','addAttendance'); //API_ID_46 : Add Attendance
        Route::get('/view_attendance','viewAttendance'); //API_ID_47 : View Attendance
        Route::get('/view_attendance/{id}','viewAttendanceById'); //API_ID_48 : View Attendance By ID
        Route::put('/edit_attendance/{id}','editAttendance'); //API_ID_49 : Edit Attendance
        Route::delete('/delete_attendance/{id}','deleteAttendanceById'); //API_ID_50 : Delete Attendance By ID
        Route::delete('/delete_all_attendance','deleteAllAttendance'); //API_ID_51 : Delete All Attendance

        Route::post('/add_certificate','addCertificate'); //API_ID_52 : Add Certificate
        Route::get('/view_certificate','viewCertificate'); //API_ID_53 : View Certificate
        Route::get('/view_certificate/{id}','viewCertificateById'); //API_ID_54 : View Certificate By ID
        Route::put('/edit_certificate/{id}','editCertificate'); //API_ID_55 : Edit Certificate
        Route::delete('/delete_certificate/{id}','deleteCertificateById'); //API_ID_56 : Delete Certificate By ID
        Route::delete('/delete_all_certificate','deleteAllCertificate'); //API_ID_57 : Delete All Certificate

        Route::post('/add_financial_year','addFinancialYear'); //API_ID_58 : Add Financial Year
        Route::get('/view_financial_year','viewFinancialYear'); //API_ID_59 : View Financial Year
        Route::get('/view_financial_year/{id}','viewFinancialYearById'); //API_ID_60 : View Financial Year By ID
        Route::put('/edit_financial_year/{id}','editFinancialYear'); //API_ID_61 : Edit Financial Year
        Route::delete('/delete_financial_year/{id}','deleteFinancialYearById'); //API_ID_62 : Delete Financial Year By ID
        Route::delete('/delete_all_financial_year','deleteAllFinancialYear'); //API_ID_63 : Delete All Financial Year
        
        Route::post('/add_installment','addInstallment'); //API_ID_64 : Add Installment
        Route::get('/view_installment','viewInstallment'); //API_ID_65 : View Installment
        Route::get('/view_installment/{id}','viewInstallmentById'); //API_ID_66 : View Installment By ID
        Route::put('/edit_installment/{id}','editInstallment'); //API_ID_67 : Edit Installment
        Route::delete('/delete_installment/{id}','deleteInstallmentById'); //API_ID_68 : Delete Installment By ID
        Route::delete('/delete_all_installment','deleteAllInstallment'); //API_ID_69 : Delete All Installment

        Route::post('/add_leave','addLeave'); //API_ID_70 : Add Leave
        Route::get('/view_leave','viewLeave'); //API_ID_71 : View Leave
        Route::get('/view_leave/{id}','viewLeaveById'); //API_ID_72 : View Leave By ID
        Route::put('/edit_leave/{id}','editLeave'); //API_ID_73 : Edit Leave
        Route::delete('/delete_leave/{id}','deleteLeaveById'); //API_ID_74 : Delete Leave
        Route::delete('/delete_all_leave','deleteAllLeave'); //API_ID_75 : Delete All Leave By ID
        
        Route::post('/add_role','addRole'); //API_ID_76 : Add Role
        Route::get('/view_role','viewRole'); //API_ID_77 : View Role
        Route::get('/view_role/{id}','viewRoleById'); //API_ID_78 : View Role By ID
        Route::put('/edit_role/{id}','editRole'); //API_ID_79 : Edit Role
        Route::delete('/delete_role/{id}','deleteRoleById'); //API_ID_80 : Delete Role By ID
        Route::delete('/delete_all_role','deleteAllRole'); //API_ID_81 : Delete All Role

        Route::post('/add_sport','addSport'); //API_ID_82 : Add Sport
        Route::get('/view_sport','viewSport'); //API_ID_83 : View Sport
        Route::get('/view_sport/{id}','viewSportById'); //API_ID_84 : View Sport By ID
        Route::put('/edit_sport/{id}','editSport'); //API_ID_85 : Edit Sport
        Route::delete('/delete_sport/{id}','deleteSportById'); //API_ID_86 : Delete Sport By ID
        Route::delete('/delete_all_sport','deleteAllSport'); //API_ID_87 : Delete All Sport

        Route::post('/add_time_table','addTimeTable'); //API_ID_88 : Add Time Table
        Route::get('/view_time_table','viewTimeTable'); //API_ID_89 : View Time Table
        Route::get('/view_time_table/{id}','viewTimeTableById'); //API_ID_90 : View Time Table By ID
        Route::put('/edit_time_table/{id}','editTimeTable'); //API_ID_91 : Edit Time Table
        Route::delete('/delete_time_table/{id}','deleteTimeTableById'); //API_ID_92 : Delete Time Table By ID
        Route::delete('/delete_all_time_table','deleteAllTimeTable'); //API_ID_93 : Delete All Time Table
        
        Route::post('/add_school_id','addSchoolId'); //API_ID_94 : Add School Id
        Route::get('/view_school_id','viewSchoolId'); //API_ID_95 : View School Id
        Route::get('/view_school_id/{id}','viewSchoolIdById'); //API_ID_96 : View School Id BY ID
        Route::put('/edit_school_id/{id}','editSchoolId'); //API_ID_97 : Edit School Id
        Route::delete('/delete_school_id/{id}','deleteSchoolIdById'); //API_ID_98 : Delete School Id By ID
        Route::delete('/delete_all_school_id','deleteAllSchoolId'); //API_ID_99 : Delete All School Id

        Route::post('/add_module','addModule'); //API_ID_100 : Add Module
        Route::get('/view_module','viewModule'); //API_ID_101 : View Module
        Route::get('/view_module/{id}','viewModuleById'); //API_ID_102 : View Module BY ID
        Route::put('/edit_module/{id}','editModule'); //API_ID_103 : Edit Module 
        Route::delete('/delete_module/{id}','deleteModuleById'); //API_ID_104 : Delete Module By ID
        Route::delete('/delete_all_module','deleteAllModule'); //API_ID_105 : Delete All Module

        Route::post('/add_sub_module','addSubModule'); //API_ID_106 : Add Sub Module
        Route::get('/view_sub_module','viewSubModule'); //API_ID_107 : View Sub Module
        Route::get('/view_sub_module/{id}','viewSubModuleById'); //API_ID_108 : View Sub Module BY ID
        Route::put('/edit_sub_module/{id}','editSubModule'); //API_ID_109 : Edit Sub Module 
        Route::delete('/delete_sub_module/{id}','deleteSubModuleById'); //API_ID_110 : Delete Sub Module By ID
        Route::delete('/delete_all_sub_module','deleteAllSubModule'); //API_ID_111 : Delete All Sub Module

        Route::post('/add_course','addCourse'); //API_ID_112 : Add Course Module
        Route::get('/view_course','viewCourse'); //API_ID_113 : View Course Module
        Route::get('/view_course/{id}','viewCourseById'); //API_ID_114 : View Course Module BY ID
        Route::put('/edit_course/{id}','editCourse'); //API_ID_115 : Edit Course Module 
        Route::delete('/delete_course/{id}','deleteCourseById'); //API_ID_116 : Delete Course Module By ID
        Route::delete('/delete_all_course','deleteAllCourse'); //API_ID_117 : Delete All Course Module

        Route::post('/add_semester','addSemester'); //API_ID_118 : Add Semester Module
        Route::get('/view_semester','viewSemester'); //API_ID_119 : View Semester Module
        Route::get('/view_semester/{id}','viewSemesterById'); //API_ID_120 : View Semester Module BY ID
        Route::put('/edit_semester/{id}','editSemester'); //API_ID_121 : Edit Semester Module 
        Route::delete('/delete_semester/{id}','deleteSemesterById'); //API_ID_122 : Delete Semester Module By ID
        Route::delete('/delete_all_semester','deleteAllSemester'); //API_ID_123 : Delete All Semester Module

        Route::post('/add_department','addDepartment'); //API_ID_124 : Add Department Module
        Route::get('/view_department','viewDepartment'); //API_ID_125 : View Department Module
        Route::get('/view_department/{id}','viewDepartmentById'); //API_ID_126 : View Department Module BY ID
        Route::put('/edit_department/{id}','editDepartment'); //API_ID_127 : Edit Department Module 
        Route::delete('/delete_department/{id}','deleteDepartmentById'); //API_ID_128 : Delete Department Module By ID
        Route::delete('/delete_all_department','deleteAllDepartment'); //API_ID_129 : Delete All Department Module
    });
*/


/* 
    commentted By: Lakshmi
    Commentted On: 15-Apr-2023
    Description: Creating group in route.

    Route::post('/register',[UserController::class, 'register']); //API_ID_1 : Register
    Route::post('/login',[UserController::class, 'login']); //API_ID_2 : Login
    Route::post('/sendResetPasswordEmail',[PasswordResetController::class,'sendResetPasswordEmail']); //API_ID_3 : Send Reset Password
    Route::post('/resetPassword/{token}',[PasswordResetController::class,'resetPassword']); //API_ID_4 : Reset Password


    Route::middleware('auth:sanctum')->group(function () {
        Route::get('/profile',[UserController::class,'profile']); //API_ID_5 : Profile
        Route::put('/editProfile/{id}',[UserController::class,'editProfile']); //API_ID_6 : Edit Profile Using ID
        Route::post('/logout',[UserController::class,'logout']); //API_ID_7 : Logout
        Route::post('/changePassword',[UserController::class,'changePassword']); //API_ID_8 : Change Password
        Route::delete('/deleteProfile/{id}',[UserController::class,'deleteProfile']); //API_ID_9 : Delete Profile    
    });

    Route::group(['middleware'=>'api'], function($routes){
        Route::post('/add_class',[MasterController::class,'addClassTable']); //API_ID_10 : Add Class
        Route::get('/view_class',[MasterController::class,'viewClassTable']); //API_ID_11 : View Class
        Route::get('/view_class/{id}',[MasterController::class,'viewClassTableById']); //API_ID_12 : View Class By ID
        Route::put('/edit_class/{id}',[MasterController::class,'editClassTable']); //API_ID_13 : Edit Class
        Route::delete('/delete_class/{id}',[MasterController::class,'deleteClassTableById']);//API_ID_14 : Delete Class
        Route::delete('/delete_all_class/',[MasterController::class,'deleteAllClassTable']);//API_ID_15 : Delete All Class

        Route::post('/add_subject',[MasterController::class,'addSubject']); //API_ID_16 : Add Subject
        Route::get('/view_subject',[MasterController::class,'viewSubject']); //API_ID_17 : View Subject
        Route::get('/view_subject/{id}',[MasterController::class,'viewSubjectById']); //API_ID_18 : View Subject By ID
        Route::put('/edit_subject/{id}',[MasterController::class,'editSubject']); //API_ID_19 : Edit Subject
        Route::delete('/delete_subject/{id}',[MasterController::class,'deleteSubjectById']); //API_ID_20 : Delete Subject By ID
        Route::delete('/delete_all_subject',[MasterController::class,'deleteAllSubject']); //API_ID_21 : Delete All Subject

        Route::post('/add_section',[MasterController::class,'addSection']); //API_ID_22 : Add Section
        Route::get('/view_section',[MasterController::class,'viewSection']); //API_ID_23 : View Section
        Route::get('/view_section/{id}',[MasterController::class,'viewSectionById']); //API_ID_25 : View Section By ID
        Route::put('/edit_section/{id}',[MasterController::class,'editSection']); //API_ID_26 : Edit Section
        Route::delete('/delete_section/{id}',[MasterController::class,'deleteSectionById']); //API_ID_27 : Delete Section By ID
        Route::delete('/delete_all_section',[MasterController::class,'deleteAllSection']); //API_ID_28 : Delete All Section

        Route::post('/add_designation',[MasterController::class,'addDesignation']); //API_ID_29 : Add Designation
        Route::get('/view_designation',[MasterController::class,'viewDesignation']); //API_ID_30 : View Designation
        Route::get('/view_designation/{id}',[MasterController::class,'viewDesignationById']); //API_ID_31 : view Designation By ID
        Route::put('/edit_designation/{id}',[MasterController::class,'editDesignation']); //API_ID_32 Edit : Designation
        Route::delete('/delete_designation/{id}',[MasterController::class,'deleteDesignationById']); //API_ID_33 : Delete Designation
        Route::delete('/delete_all_designation',[MasterController::class,'deleteAllDesignation']); //API_ID_34 : Delete All Designation

        Route::post('/add_board',[MasterController::class,'addBoard']); //API_ID_35 : Add Board
        Route::get('/view_board',[MasterController::class,'viewBoard']); //API_ID_36 : View Board
        Route::get('/view_board/{id}',[MasterController::class,'viewBoardById']); //API_ID_37 : View Board By ID
        Route::put('/edit_board/{id}',[MasterController::class,'editBoard']); //API_ID_38 : Edit Board
        Route::delete('/delete_board/{id}',[MasterController::class,'deleteBoardById']); //API_ID_39 : Delete Board By ID
        Route::delete('/delete_all_board',[MasterController::class,'deleteAllBoard']); //API_ID_40 : Delete All Board

        Route::post('/add_caste',[MasterController::class,'addCaste']); //API_ID_41 : Add Class
        Route::get('/view_caste',[MasterController::class,'viewCaste']); //API_ID_42 : View Caste
        Route::get('/view_caste/{id}',[MasterController::class,'viewCasteById']); //API_ID_43 : View Caste By ID
        Route::put('/edit_caste/{id}',[MasterController::class,'editCaste']); //API_ID_44 : Edit Caste
        Route::delete('/delete_caste/{id}',[MasterController::class,'deleteCasteById']); //API_ID_45 : Delete Caste By ID
        Route::delete('/delete_all_caste',[MasterController::class,'deleteAllCaste']); //API_ID_46 : Delete All Caste

        Route::post('/add_attendance',[MasterController::class,'addAttendance']); //API_ID_47 : Add Attendance
        Route::get('/view_attendance',[MasterController::class,'viewAttendance']); //API_ID_48 : View Attendance
        Route::get('/view_attendance/{id}',[MasterController::class,'viewAttendanceById']); //API_ID_49 : View Attendance By ID
        Route::put('/edit_attendance/{id}',[MasterController::class,'editAttendance']); //API_ID_50 : Edit Attendance
        Route::delete('/delete_attendance/{id}',[MasterController::class,'deleteAttendanceById']); //API_ID_51 : Delete Attendance By ID
        Route::delete('/delete_all_attendance',[MasterController::class,'deleteAllAttendance']); //API_ID_52 : Delete All Attendance

        Route::post('/add_certificate',[MasterController::class,'addCertificate']); //API_ID_53 : Add Certificate
        Route::get('/view_certificate',[MasterController::class,'viewCertificate']); //API_ID_54 : View Certificate
        Route::get('/view_certificate/{id}',[MasterController::class,'viewCertificateById']); //API_ID_55 : View Certificate By ID
        Route::put('/edit_certificate/{id}',[MasterController::class,'editCertificate']); //API_ID_56 : Edit Certificate
        Route::delete('/delete_certificate/{id}',[MasterController::class,'deleteCertificateById']); //API_ID_57 : Delete Certificate By ID
        Route::delete('/delete_all_certificate',[MasterController::class,'deleteAllCertificate']); //API_ID_58 : Delete All Certificate

        Route::post('/add_financial_year',[MasterController::class,'addFinancialYear']); //API_ID_59 : Add Financial Year
        Route::get('/view_financial_year',[MasterController::class,'viewFinancialYear']); //API_ID_60 : View Financial Year
        Route::get('/view_financial_year/{id}',[MasterController::class,'viewFinancialYearById']); //API_ID_61 : View Financial Year By ID
        Route::put('/edit_financial_year/{id}',[MasterController::class,'editFinancialYear']); //API_ID_62 : Edit Financial Year
        Route::delete('/delete_financial_year/{id}',[MasterController::class,'deleteFinancialYearById']); //API_ID_63 : Delete Financial Year By ID
        Route::delete('/delete_all_financial_year',[MasterController::class,'deleteAllFinancialYear']); //API_ID_64 : Delete All Financial Year
        
        Route::post('/add_installment',[MasterController::class,'addInstallment']); //API_ID_65 : Add Installment
        Route::get('/view_installment',[MasterController::class,'viewInstallment']); //API_ID_66 : View Installment
        Route::get('/view_installment/{id}',[MasterController::class,'viewInstallmentById']); //API_ID_67 : View Installment By ID
        Route::put('/edit_installment/{id}',[MasterController::class,'editInstallment']); //API_ID_68 : Edit Installment
        Route::delete('/delete_installment/{id}',[MasterController::class,'deleteInstallmentById']); //API_ID_69 : Delete Installment By ID
        Route::delete('/delete_all_installment',[MasterController::class,'deleteAllInstallment']); //API_ID_70 : Delete All Installment

        Route::post('/add_leave',[MasterController::class,'addLeave']); //API_ID_71 : Add Leave
        Route::get('/view_leave',[MasterController::class,'viewLeave']); //API_ID_72 : View Leave
        Route::get('/view_leave/{id}',[MasterController::class,'viewLeaveById']); //API_ID_73 : View Leave By ID
        Route::put('/edit_leave/{id}',[MasterController::class,'editLeave']); //API_ID_74 : Edit Leave
        Route::delete('/delete_leave/{id}',[MasterController::class,'deleteLeaveById']); //API_ID_75 : Delete Leave
        Route::delete('/delete_all_leave',[MasterController::class,'deleteAllLeave']); //API_ID_76 : Delete All Leave By ID
        
        Route::post('/add_role',[MasterController::class,'addRole']); //API_ID_77 : Add Role
        Route::get('/view_role',[MasterController::class,'viewRole']); //API_ID_78 : View Role
        Route::get('/view_role/{id}',[MasterController::class,'viewRoleById']); //API_ID_79 : View Role By ID
        Route::put('/edit_role/{id}',[MasterController::class,'editRole']); //API_ID_80 : Edit Role
        Route::delete('/delete_role/{id}',[MasterController::class,'deleteRoleById']); //API_ID_81 : Delete Role By ID
        Route::delete('/delete_all_role',[MasterController::class,'deleteAllRole']); //API_ID_82 : Delete All Role

        Route::post('/add_sport',[MasterController::class,'addSport']); //API_ID_83 : Add Sport
        Route::get('/view_sport',[MasterController::class,'viewSport']); //API_ID_84 : View Sport
        Route::get('/view_sport/{id}',[MasterController::class,'viewSportById']); //API_ID_85 : View Sport By ID
        Route::put('/edit_sport/{id}',[MasterController::class,'editSport']); //API_ID_86 : Edit Sport
        Route::delete('/delete_sport/{id}',[MasterController::class,'deleteSportById']); //API_ID_87 : Delete Sport By ID
        Route::delete('/delete_all_sport',[MasterController::class,'deleteAllSport']); //API_ID_88 : Delete All Sport

        Route::post('/add_time_table',[MasterController::class,'addTimeTable']); //API_ID_89 : Add Time Table
        Route::get('/view_time_table',[MasterController::class,'viewTimeTable']); //API_ID_90 : View Time Table
        Route::get('/view_time_table/{id}',[MasterController::class,'viewTimeTableById']); //API_ID_91 : View Time Table By ID
        Route::put('/edit_time_table/{id}',[MasterController::class,'editTimeTable']); //API_ID_92 : Edit Time Table
        Route::delete('/delete_time_table/{id}',[MasterController::class,'deleteTimeTableById']); //API_ID_93 : Delete Time Table By ID
        Route::delete('/delete_all_time_table',[MasterController::class,'deleteAllTimeTable']); //API_ID_94 : Delete All Time Table
        
        Route::post('/add_school_id',[MasterController::class,'addSchoolId']); //API_ID_95 : Add School Id
        Route::get('/view_school_id',[MasterController::class,'viewSchoolId']); //API_ID_96 : View School Id
        Route::get('/view_school_id/{id}',[MasterController::class,'viewSchoolIdById']); //API_ID_97 : View School Id BY ID
        Route::put('/edit_school_id/{id}',[MasterController::class,'editSchoolId']); //API_ID_98 : Edit School Id
        Route::delete('/delete_school_id/{id}',[MasterController::class,'deleteSchoolIdById']); //API_ID_99 : Delete School Id By ID
        Route::delete('/delete_all_school_id',[MasterController::class,'deleteAllSchoolId']); //API_ID_100 : Delete All School Id

        Route::post('/add_module',[MasterController::class,'addModule']); //API_ID_101 : Add Module
        Route::get('/view_module',[MasterController::class,'viewModule']); //API_ID_102 : View Module
        Route::get('/view_module/{id}',[MasterController::class,'viewModuleById']); //API_ID_103 : View Module BY ID
        Route::put('/edit_module/{id}',[MasterController::class,'editModule']); //API_ID_104 : Edit Module 
        Route::delete('/delete_module/{id}',[MasterController::class,'deleteModuleById']); //API_ID_105 : Delete Module By ID
        Route::delete('/delete_all_module',[MasterController::class,'deleteAllModule']); //API_ID_106 : Delete All Module

        Route::post('/add_sub_module',[MasterController::class,'addSubModule']); //API_ID_107 : Add Sub Module
        Route::get('/view_sub_module',[MasterController::class,'viewSubModule']); //API_ID_108 : View Sub Module
        Route::get('/view_sub_module/{id}',[MasterController::class,'viewSubModuleById']); //API_ID_109 : View Sub Module BY ID
        Route::put('/edit_sub_module/{id}',[MasterController::class,'editSubModule']); //API_ID_110 : Edit Sub Module 
        Route::delete('/delete_sub_module/{id}',[MasterController::class,'deleteSubModuleById']); //API_ID_112 : Delete Sub Module By ID
        Route::delete('/delete_all_sub_module',[MasterController::class,'deleteAllSubModule']); //API_ID_113 : Delete All Sub Module

    });
    */


    /* Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
        return $request->user();
    });
*/

//========================================= End User API By Lakshmi =======================================================



