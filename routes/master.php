<?php

/**
 * | Created On-23-05-2023 
 * | Author - Anshu Kumar
 * | Routes Specified for the Master Crud Operations
 */

use App\Http\Controllers\API\Master\DiscountGroupController;
use App\Http\Controllers\API\Master\FeeHeadTypeController;
use App\Http\Controllers\API\Master\FeeHeadController;
use App\Http\Controllers\API\Master\ClassFeeMasterController; 
use App\Http\Controllers\API\Master\FeeDefinitionController;

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

    //fee head tye
    Route::controller(FeeHeadTypeController::class)->group(function () {
        Route::post('feehead-type/crud/store', 'store');                    // Store 
        Route::post('feehead-type/crud/edit', 'edit');                      // Update
        Route::post('feehead-type/crud/show', 'show');                      // Get by Id
        Route::post('feehead-type/crud/retrieve-all', 'retrieveAll');       // Get all records
    });

    //fee head
    Route::controller(FeeHeadController::class)->group(function () {
        Route::post('fee-head/crud/store', 'store');                    // Store 
        Route::post('fee-head/crud/edit', 'edit');                      // Update
        Route::post('fee-head/crud/show', 'show');                      // Get by Id
        Route::post('fee-head/crud/retrieve-all', 'retrieveAll');       // Get all records
    });

    //class fee master
    Route::controller(ClassFeeMasterController::class)->group(function () {
        Route::post('classfee-master/crud/store', 'store');                    // Store 
        Route::post('classfee-master/crud/edit', 'edit');                      // Update
        Route::post('classfee-master/crud/show', 'show');                      // Get by Id
        Route::post('classfee-master/crud/retrieve-all', 'retrieveAll');       // Get all records
    });

    //fee definition
    Route::controller(FeeDefinitionController::class)->group(function () {
        Route::post('fee-definition/crud/store', 'store');                    // Store 
        Route::post('fee-definition/crud/edit', 'edit');                      // Update
        Route::post('fee-definition/crud/show', 'show');                      // Get by Id
        Route::post('fee-definition/crud/retrieve-all', 'retrieveAll');       // Get all records
    });

   
});


