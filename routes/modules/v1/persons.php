<?php


use App\Http\Controllers\API\PersonController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(PersonController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new Book
    Route::post('person', 'storePerson')
         ->name('book.create');

    // Route to view a random Book
    Route::get('person', 'viewPerson')
         ->name('person.view');

    // Route to view a list of all Books
    Route::get('persons', 'viewPersons')
         ->name('person.view');

    // Route to update an existing Book by its ID
    Route::put('person/{book_id}', 'updatePerson')
         ->name('person.update');

    // Route to delete a specific Book by its ID
    Route::delete('person/{book_id}', 'deletePerson')
         ->name('person.delete');
});