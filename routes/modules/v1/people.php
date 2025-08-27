<?php


use App\Http\Controllers\API\PersonController;
use Illuminate\Support\Facades\Route;

Route::prefix("v1")->controller(PersonController::class) //->middleware('auth:sanctum')
->group(function () {
    // ALL-AROUND APIS ON FILE CONTROLLER //
    // Route to store a new person
    Route::post('person', 'storePerson')
         ->name('person.create');

    // Route to view a random person
    Route::get('person', 'viewPerson')
         ->name('person.view');

    // Route to view a list of all people
    Route::get('people', 'viewPeople')
         ->name('people.view');

    // Route to update an existing person by its ID
    Route::put('person/{person_id}', 'updatePerson')
         ->name('person.update');

    // Route to delete a specific person by its ID
    Route::delete('person/{person_id}', 'deletePerson')
         ->name('person.delete');
});