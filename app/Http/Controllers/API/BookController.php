<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Services\BookService;
use App\Http\Requests\BookRequest;
use App\Http\Resources\BookResource;
use App\Http\Resources\BookCollection;
use Throwable;

class BookController extends BaseController
{

    public $service;
    public function __construct(BookService $service){
        $this->service = $service;

    }


    /**
     * Store a newly created resource in storage.
     *
     * @OA\Post(
     *     path="/api/v1/book",
     *     summary="Store a book",
     *     description="Store a book",
     *     tags={"Book"},
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/BookRequest")
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
    public function storeBook(BookRequest $request){
        try {
            // Store the fruit using the service and get the response
            $response = $this->service->storeBook(
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

    /**
     * @OA\Get(
     *     path="/api/v1/book",
     *     summary="View a book",
     *     description="View a book",
     *     tags={"Book"},
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
    public function viewBook(BookRequest $request){
        try{

            $fruitModel = $this->service->viewBook();

            // Instantiate the resource and get its array output
            $fruitResourceArray = (new BookResource($fruitModel))->toArray($request);

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
                'message' => 'Failed to view a book.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    /**
     * @OA\Get(
     *     path="/api/v1/books",
     *     summary="View books",
     *     description="View books",
     *     tags={"Book"},
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
     *     @OA\Parameter(
     *         description="Pagination",
     *         in="query",
     *         name="pagination",
     *         required=false,
     *         example="1,10",
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
    public function viewBooks(BookRequest $request){
        try{

            $fruits = $this->service->viewBooks(
                limit: $request->query('limit'),
                search_query:  $request->query('search_query'),
                pagination: $request->query('pagination'),
            );            // Instantiate the resource and get its array output
            $booksCollection = new BookCollection($fruits);
            
            $response = [
                'is_success' => true,
                'message '=> 'Fruits displayed successfully.',
                'fruits' => $booksCollection
            ];
            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to view books.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ], 500);
        }
    }

    /**
     * @OA\Put(
     *     path="/api/v1/book/{id}",
     *     summary="Update a book",
     *     description="Update a book",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         description="Book ID",
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
     *                 property="title",
     *                 type="string",
     *                 example="The Catcher in the Rye"
     *             ),
     *             @OA\Property(
     *                 property="author",
     *                 type="string",
     *                 example="J.D. Salinger"
     *             ),
     *             @OA\Property(
     *                 property="isbn",
     *                 type="string",
     *                 example="978-0-316-30380-0"
     *             ),
     *             @OA\Property(
     *                 property="genre",
     *                 type="string",
     *                 example="Fiction"
     *             ),
     *             @OA\Property(
     *                 property="publication_year",
     *                 type="integer",
     *                 example=1951
     *             ),
     *             @OA\Property(
     *                 property="publisher",
     *                 type="string",
     *                 example="Little, Brown and Company"
     *             ),
     *             @OA\Property(
     *                 property="pages",
     *                 type="integer",
     *                 example=272
     *             ),
     *             @OA\Property(
     *                 property="language",
     *                 type="string",
     *                 example="English"
     *             ),
     *             @OA\Property(
     *                 property="summary",
     *                 type="string",
     *                 example="The Catcher in the Rye is a classic coming-of-age novel that follows the story of Holden Caulfield, a disillusioned teenager struggling to find his place in the world."
     *             ),
     *             @OA\Property(
     *                 property="rating_avg",
     *                 type="number",
     *                 example=4.21
     *             ),
     *             @OA\Property(
     *                 property="number_of_reviews",
     *                 type="integer",
     *                 example=2000
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
     * )
     */
    public function updateBook(BookRequest $request, string $id)
    {
        try{

            $response = $this->service->updateBook(
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

    /**
     * @OA\Delete(
     *     path="/api/v1/book/{id}",
     *     summary="Delete a book",
     *     description="Delete a book",
     *     tags={"Book"},
     *     @OA\Parameter(
     *         description="Book id",
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
    public function deleteBook(string $id)
    {
        try{
            $response = $this->service->deleteBook($id);

            return response()->json($response,200);

        }catch(Throwable $e){
            return response()->json([
                'message' => 'Failed to delete a book.',
                'error' => config('app.debug') ? $e->getMessage() : 'Internal Server Error',
            ]);
        }
    }
}
