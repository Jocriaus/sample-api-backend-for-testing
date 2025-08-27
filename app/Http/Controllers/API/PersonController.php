<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Services\PersonService;
use App\Http\Requests\PersonRequest;
use App\Http\Resources\PersonResource;
use App\Http\Resources\PersonCollection;
use Throwable;
class PersonController extends BaseController
{
    public $service;
    public function __construct(PersonService $service){
        $this->service = $service;

    }

    public function storePerson(PersonRequest $request){
        try {
            // Store the fruit using the service and get the response
            $response = $this->service->storePerson(
                data: $request->all()
            );

            // Return a successful JSON response
            return response()->json($response, 200);

        } catch (Throwable $e) {
            // Return an error JSON response in case of an exception
            return response()->json([
                'message' => 'Failed to store a fruit.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewPerson(PersonRequest $request){
        try{

            $personModel = $this->service->viewPerson();

            // Instantiate the resource and get its array output
            $personResourceArray = (new PersonResource($personModel))->toArray($request);

            // Build the final response array with your additional data
            $response = [
                'is_success' => true,
                'message '=> 'A person displayed successfully.',
                'person' => $personResourceArray // Nest the clean array output
            ];
            
            // Return the final array as a JSON response
            return response()->json($response, 200);
            
        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view a book.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewPersons(PersonRequest $request){
        try{

            $persons = $this->service->viewPersons(
                limit: $request->query('limit'),
                search_query:  $request->query('search_query'),
                pagination: $request->query('pagination'),
            );            // Instantiate the resource and get its array output
            $personsCollection = new PersonCollection($persons);
            
            $response = [
                'is_success' => true,
                'message '=> 'Persons displayed successfully.',
                'persons' => $personsCollection
            ];
            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view persons.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function updatePerson(PersonRequest $request, string $id)
    {
        try{

            $response = $this->service->updatePerson(
                id: $id,
                data: $request->all()
            );

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to update a book.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function deletePerson(string $id)
    {
        try{
            $response = $this->service->deletePerson($id);

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to delete a book.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ]);
        }
    }
}
