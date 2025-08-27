<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\API\BaseController;
use Illuminate\Http\Request;
use App\Services\ManufacturerService;
use App\Http\Requests\ManufacturerRequest;
use App\Http\Resources\ManufacturerResource;
use App\Http\Resources\ManufacturerCollection;
use Throwable;

class ManufacturerController extends BaseController
{
    public $service;
    public function __construct(ManufacturerService $service){
        $this->service = $service;

    }

    public function storeManufacturer(ManufacturerRequest $request){
        try {
            // Store the fruit using the service and get the response
            $response = $this->service->storeManufacturer(
                data: $request->all()
            );

            // Return a successful JSON response
            return response()->json($response, 200);

        } catch (Throwable $e) {
            // Return an error JSON response in case of an exception
            return response()->json([
                'message' => 'Failed to store a manufacturer.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewManufacturer(ManufacturerRequest $request){
        try{

            $manufacturerModel = $this->service->viewManufacturer();

            // Instantiate the resource and get its array output
            $manufacturerResourceArray = (new ManufacturerResource($manufacturerModel))->toArray($request);

            // Build the final response array with your additional data
            $response = [
                'is_success' => true,
                'message '=> 'A manufacturer displayed successfully.',
                'manufacturer' => $manufacturerResourceArray // Nest the clean array output
            ];
            
            // Return the final array as a JSON response
            return response()->json($response, 200);
            
        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view a manufacturer.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewManufacturers(ManufacturerRequest $request){
        try{

            $manufacturer = $this->service->viewManufacturers(
                limit: $request->query('limit'),
                search_query:  $request->query('search_query'),
                pagination: $request->query('pagination'),
            );            // Instantiate the resource and get its array output
            $manufacturerCollection = new ManufacturerCollection($manufacturer);
            
            $response = [
                'is_success' => true,
                'message '=> 'Manufacturer displayed successfully.',
                'manufacturers' => $manufacturerCollection
            ];
            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view manufacturer.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function updateManufacturer(ManufacturerRequest $request, string $id)
    {
        try{

            $response = $this->service->updateManufacturer(
                id: $id,
                data: $request->all()
            );

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to update a manufacturer.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function deleteManufacturer(string $id)
    {
        try{
            $response = $this->service->deleteManufacturer($id);

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to delete a manufacturer.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ]);
        }
    }
}
