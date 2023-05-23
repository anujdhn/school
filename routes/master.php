<?php

/**
 * | Created On-23-05-2023 
 * | Author - Anshu Kumar
 * | Routes Specified for the Master Crud Operations
 */

use App\Http\Controllers\API\Master\DiscountGroupController;

//  Protected Routes

// Route::middleware('auth:sanctum')->group(function () {
Route::controller(DiscountGroupController::class)->group(function () {
    Route::post('discount-group/crud/store', 'store');
});
// });
