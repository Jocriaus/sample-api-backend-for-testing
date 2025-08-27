<?php

namespace App\Services;
use App\Models\Book;
use App\Http\Resources\BookCollection;
class BookService
{
    /**
     * Create a new BookService instance.
     *
     * @return void
     */
    public function __construct()
    {
        // Constructor logic if needed
    }

    /**
     * Example method for the service.
     * Replace this with your actual business logic.
     *
     * @param array $data
     * @return mixed
     */
    public function storeBook(array $data)
    {
        Book::create([
            'title' => $data['title'],
            'author' => $data['author'],
            'isbn' => $data['isbn'],
            'genre' => $data['genre'], 
            'publication_year' => $data['publication_year'], 
            'publisher' => $data['publisher'], 
            'pages' => $data['pages'], 
            'language' => $data['language'], 
            'summary' => $data['summary'], 
            'rating_avg' => $data['rating_avg'],
            'number_of_reviews' => $data['number_of_reviews'],
        ]);

        $response = [
            'is_success' => true,
            'message '=> 'Book added successfully.',
        ];
            
        return $response; // Placeholder return
    }

    public function viewBooks(?string $limit = null, ?string $search_query = null, ?string $pagination = null)
    {
        $query = Book::query();

        if ($limit){
            $query->limit($limit);
        }else {
            $query->limit(10);
        }

        // Search the books by the given search query
        if ($search_query) {
            $search = strtolower($search_query);
            $query->where(function ($q) use ($search) {
                // Search by the following fields
                $fields = [
                    'title','author','isbn','genre', 'publication_year', 
                    'publisher', 'pages', 'language', 'summary', 'rating_avg',
                    'number_of_reviews',
                ];

                // Iterate over the fields and search by the given search query
                foreach ($fields as $field) {
                    $q->orWhereRaw("LOWER($field) LIKE ?", ["%{$search}%"]);
                }
            });
        }

        // --- Pagination Handling ---
        if ($pagination) {
            $paginationArray = explode(',', $pagination);
            $page = is_numeric($paginationArray[0]) ? (int)$paginationArray[0] : 10;
            $perPage = (isset($paginationArray[1]) && is_numeric($paginationArray[1])) ? (int)$paginationArray[1] : 1;

            // If limit is set, it overrides per-page size
            if ($limit && is_numeric($limit)) {
                $perPage = (int)$limit;
            }

            return $query->paginate($perPage, ['*'], 'page', $page);
        }

        // --- No Pagination ---
        if ($limit && is_numeric($limit)) {
            $query->limit((int)$limit);
        } else {
            $query->limit(10);
        }

        return $query->get();
    }

    public function viewBook()
    {

        $book = Book::all()->random();
        
        return $book;
    }


    public function updateBook($id, array $data)
    {
        $book = Book::find($id);

        if (!$book) {
            $response = [
                'is_success' => false,
                'message '=> 'Fruit not found.',
            ];

            return $response;
        }

        $book->title = $data['title'];
        $book->author = $data['author'];
        $book->isbn = $data['isbn'];
        $book->genre = $data['genre'];
        $book->publication_year = $data['publication_year'];
        $book->publisher = $data['publisher'];
        $book->pages = $data['pages'];
        $book->language = $data['language'];
        $book->summary = $data['summary'];
        $book->rating_avg = $data['rating_avg'];
        $book->number_of_reviews = $data['number_of_reviews'];

        $book->save();

        $response = [
            'is_success' => true,
            'message '=> 'A book was updated successfully.',
        ];
            
        return $response;
    }

    public function deleteBook($id)
    {
        $book = Book::find($id);

        if (!$book) {
            $response = [
                'is_success' => false,
                'message '=> 'This can\'t be deleted, book not found.',
            ];

            return $response;
        }
        
        $book->delete();

        $response = [
            'is_success' => true,
            'message '=> 'A book updated successfully.',
        ];
            
        return $response;
    }


}
