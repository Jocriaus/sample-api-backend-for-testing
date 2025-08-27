<?php


use App\Http\Controllers\API\ProductController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(ProductController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new product
    Route::post('product', 'storeProduct')
         ->name('product.create');

    // Route to view a random product
    Route::get('product', 'viewProduct')
         ->name('product.view');

    // Route to view a list of all product
    Route::get('products', 'viewProducts')
         ->name('products.view');

    // Route to update an existing product by its ID
    Route::put('product/{product_id}', 'updateProduct')
         ->name('product.update');

    // Route to delete a specific product by its ID
    Route::delete('product/{product_id}', 'deleteProduct')
         ->name('product.delete');
});