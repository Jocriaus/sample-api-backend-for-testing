<?php


use App\Http\Controllers\API\FruitController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(FruitController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new fruit
    Route::post('fruit', 'storeFruit')
         ->name('fruit.create');

    // Route to view a random fruit
    Route::get('fruit', 'viewFruit')
         ->name('fruit.view');

    // Route to view a list of all fruits
    Route::get('fruits', 'viewFruits')
         ->name('fruits.view');

    // Route to update an existing fruit by its ID
    Route::put('fruit/{fruit_id}', 'updateFruit')
         ->name('fruit.update');

    // Route to delete a specific fruit by its ID
    Route::delete('fruit/{fruit_id}', 'deleteFruit')
         ->name('fruit.delete');
});