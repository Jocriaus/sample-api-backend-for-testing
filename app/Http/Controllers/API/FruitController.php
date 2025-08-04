<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\FruitService;
use App\Http\Requests\FruitRequest;
use App\Http\Resources\FruitResource;
use App\Http\Resources\FruitCollection;
use Throwable;
class FruitController extends BaseController
{

    public $service;
    public function __construct(FruitService $service){
        $this->service = $service;

    }

    /**
     * @OA\Post(
     *     path="/api/v1/fruit",
     *     summary="Store Fruit",
     *     description="Store a fruit",
     *     tags={"Fruit"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/FruitRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=401,
     *         description="Unauthorized"
     *     ),
     *     @OA\Response(
     *         response=422,
     *         description="Validation error"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function storeFruit(FruitRequest $request)
    {
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
    /**
     * @OA\Get(
     *     path="/api/v1/fruit",
     *     summary="View Fruit",
     *     description="View a fruit",
     *     tags={"Fruit"},
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function viewFruit(FruitRequest $request){
        try{

            $fruitModel = $this->service->viewFruit();

            // Instantiate the resource and get its array output
            $fruitResourceArray = (new FruitResource($fruitModel))->toArray($request);

            // Build the final response array with your additional data
            $response = [
                'is_success' => true,
                'message '=> 'A fruit displayed successfully.',
                'fruit' => $fruitResourceArray // Nest the clean array output
            ];
            
            // Return the final array as a JSON response
            return response()->json($response, 200);
            
        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view users.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }
    /**
     * @OA\Get(
     *     path="/api/v1/fruits",
     *     summary="View Fruits",
     *     description="View fruits",
     *     tags={"Fruit"},
     *     @OA\Parameter(
     *         description="Limit",
     *         in="query",
     *         name="limit",
     *         required=false,
     *         example="10",
     *         @OA\Schema(
     *             type="integer",
     *             format="int32"
     *         )
     *     ),
     *     @OA\Parameter(
     *         description="Search query",
     *         in="query",
     *         name="search_query",
     *         required=false,
     *         example="apple",
     *         @OA\Schema(
     *             type="string"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function viewFruits(FruitRequest $request){
        try{

            $fruits = $this->service->viewFruits(
                limit: $request->query('limit'),
                search_query:  $request->query('search_query'),
            );            // Instantiate the resource and get its array output
            $fruitsCollection = new FruitCollection(new FruitResource($fruits));
            
            $response = [
                'is_success' => true,
                'message '=> 'Fruits displayed successfully.',
                'fruits' => $fruitsCollection
            ];
            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view users.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }
    /**`
     * @OA\Put(
     *     path="/api/v1/fruit/{id}",
     *     summary="Update Fruit",
     *     description="Update a fruit",
     *     tags={"Fruit"},
     *     @OA\Parameter(
     *         description="Fruit id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(
     *                 property="name",
     *                 type="string",
     *                 example="Apple"
     *             ),
     *             @OA\Property(
     *                 property="scientific_name",
     *                 type="string",
     *                 example="Malus domestica"
     *             ),
     *             @OA\Property(
     *                 property="color",
     *                 type="string",
     *                 example="Red"
     *             ),
     *             @OA\Property(
     *                 property="taste_profile",
     *                 type="string",
     *                 example="Sweet"
     *             ),
     *             @OA\Property(
     *                 property="season",
     *                 type="string",
     *                 example="Autumn"
     *             ),
     *             @OA\Property(
     *                 property="is_seasonal",
     *                 type="boolean",
     *                 example=true
     *             ),
     *             @OA\Property(
     *                 property="price_per_kg",
     *                 type="number",
     *                 example=1.99
     *             ),
     *             @OA\Property(
     *                 property="origin_country",
     *                 type="string",
     *                 example="United States"
     *             ),
     *             @OA\Property(
     *                 property="description",
     *                 type="string",
     *                 example="This is a description of the fruit."
     *             )
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     **/
    public function updateFruit(FruitRequest $request, string $id)
    {
        try{

            $response = $this->service->updateFruit(
                id: $id,
                data: $request->all()
            );

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to update users.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }
    /**
     * @OA\Delete(
     *     path="/api/v1/fruit/{id}",
     *     summary="Delete Fruit",
     *     description="Delete a fruit",
     *     tags={"Fruit"},
     *     @OA\Parameter(
     *         description="Fruit id",
     *         in="path",
     *         name="id",
     *         required=true,
     *         example="1",
     *         @OA\Schema(
     *             type="integer",
     *             format="int64"
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Successful response"
     *     ),
     *     @OA\Response(
     *         response=500,
     *         description="Internal Server Error"
     *     )
     * )
     */
    public function deleteFruit(string $id)
    {
        try{
            $response = $this->service->deleteFruit($id);

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to delete a fruit.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ]);
        }
    }
}
