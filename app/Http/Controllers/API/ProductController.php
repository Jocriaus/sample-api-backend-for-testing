<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\ProductService;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductResource;
use App\Http\Resources\ProductCollection;
use Throwable;

class ProductController extends BaseController
{
    public $service;
    public function __construct(ProductService $service){
        $this->service = $service;

    }

    public function storeProduct(ProductRequest $request){
        try {
            // Store the fruit using the service and get the response
            $response = $this->service->storeProduct(
                data: $request->all()
            );

            // Return a successful JSON response
            return response()->json($response, 200);

        } catch (Throwable $e) {
            // Return an error JSON response in case of an exception
            return response()->json([
                'message' => 'Failed to store a product.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewProduct(ProductRequest $request){
        try{

            $productModel = $this->service->viewProduct();

            // Instantiate the resource and get its array output
            $productResourceArray = (new ProductResource($productModel))->toArray($request);

            // Build the final response array with your additional data
            $response = [
                'is_success' => true,
                'message '=> 'A product displayed successfully.',
                'product' => $productResourceArray // Nest the clean array output
            ];
            
            // Return the final array as a JSON response
            return response()->json($response, 200);
            
        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view a product.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function viewProducts(ProductRequest $request){
        try{

            $products = $this->service->viewProducts(
                limit: $request->query('limit'),
                search_query:  $request->query('search_query'),
                pagination: $request->query('pagination'),
            );            // Instantiate the resource and get its array output
            $peopleCollection = new ProductCollection($products);
            
            $response = [
                'is_success' => true,
                'message '=> 'Products displayed successfully.',
                'product' => $peopleCollection
            ];
            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view People.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function updateProduct(ProductRequest $request, string $id)
    {
        try{

            $response = $this->service->updateProduct(
                id: $id,
                data: $request->all()
            );

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to update a product record.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    public function deleteProduct(string $id)
    {
        try{
            $response = $this->service->deleteProduct($id);

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to delete a product.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ]);
        }
    }
}
