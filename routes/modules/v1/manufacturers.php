<?php


use App\Http\Controllers\API\ManufacturerController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(ManufacturerController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new manufacturer
    Route::post('manufacturer', 'storeManufacturer')
         ->name('manufacturer.create');

    // Route to view a random manufacturer
    Route::get('manufacturer', 'viewManufacturer')
         ->name('manufacturer.view');

    // Route to view a list of all manufacturer
    Route::get('manufacturers', 'viewManufacturers')
         ->name('manufacturers.view');

    // Route to update an existing manufacturer by its ID
    Route::put('manufacturer/{manufacturer_id}', 'updateManufacturer')
         ->name('manufacturer.update');

    // Route to delete a specific manufacturer by its ID
    Route::delete('manufacturer/{manufacturer_id}', 'deleteManufacturer')
         ->name('manufacturer.delete');
});