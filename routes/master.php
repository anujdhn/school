<?php

/**
 * | Created On-23-05-2023 
 * | Author - Anshu Kumar
 * | Routes Specified for the Master Crud Operations
 */

use App\Http\Controllers\API\Master\DiscountGroupController;

//  Protected Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(DiscountGroupController::class)->group(function () {
        Route::post('discount-group/crud/store', 'store');          // Store 
        Route::post('discount-group/crud/edit', 'edit');             // Update
        Route::post('discount-group/crud/show', 'show');             // Get by Id
        Route::post('discount-group/crud/retrieve-all', 'retrieveAll');             // Get all Discount Groups
    });
});
