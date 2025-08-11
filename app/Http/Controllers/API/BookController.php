<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use App\Http\Resources\FruitResource;
use App\Http\Resources\FruitCollection;
use Throwable;

class BookController extends BaseController
{

    public $service;
    public function __construct(BookService $service){
        $this->service = $service;

    }



    public function storeBook(BookRequest $request){
        try {
            // Store the fruit using the service and get the response
            $response = $this->service->storeFruit(
                data: $request->all()
            );

            // Return a successful JSON response
            return response()->json($response, 200);

        } catch (Throwable $e) {
            // Return an error JSON response in case of an exception
            return response()->json([
                'message' => 'Failed to store fruit.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }
}
