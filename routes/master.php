<?php

/**
 * | Created On-23-05-2023 
 * | Author - Anshu Kumar
 * | Routes Specified for the Master Crud Operations
 */

use App\Http\Controllers\API\Master\DiscountGroupController;
use App\Http\Controllers\API\Master\DiscountGroupMapController;
use App\Http\Controllers\API\master\StudentBusFeeController;

//  Protected Routes

Route::middleware('auth:sanctum')->group(function () {
    Route::controller(DiscountGroupController::class)->group(function () {
        Route::post('discount-group/crud/store', 'store');          // Store 
        Route::post('discount-group/crud/edit', 'edit');             // Update
        Route::post('discount-group/crud/show', 'show');             // Get by Id
        Route::post('discount-group/crud/retrieve-all', 'retrieveAll');             // Get all Discount Groups
    });

    // Discount Group Maps
    Route::controller(DiscountGroupMapController::class)->group(function () {
        Route::post('discount-group-map/crud/store', 'store');           // Store
        Route::post('discount-group-map/crud/edit', 'edit');              // Update Record
        Route::post('discount-group-map/crud/show', 'show');              // Get Record By id
        Route::post('discount-group-map/crud/retrieve-all', 'retrieveAll');              // Get Record By id
    });

    // Student Bus Fee Masters
    Route::controller(StudentBusFeeController::class)->group(function () {
        Route::post('bus-fee/crud/store', 'store');                              // Add Record
        Route::post('bus-fee/crud/edit', 'edit');                               // Update Record
        Route::post('bus-fee/crud/show', 'show');                              // Show Record by id
        Route::post('bus-fee/crud/retrieve-all', 'retrieveAll');              // Fetch all data
    });
});
