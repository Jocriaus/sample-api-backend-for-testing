<?php


use App\Http\Controllers\API\BookController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(BookController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new Book
    Route::post('book', 'storeBook')
         ->name('book.create');

    // Route to view a random Book
    Route::get('book', 'viewBook')
         ->name('book.view');

    // Route to view a list of all Books
    Route::get('books', 'viewBooks')
         ->name('books.view');

    // Route to update an existing Book by its ID
    Route::put('book/{book_id}', 'updateBook')
         ->name('book.update');

    // Route to delete a specific Book by its ID
    Route::delete('book/{book_id}', 'deleteBook')
         ->name('book.delete');
});