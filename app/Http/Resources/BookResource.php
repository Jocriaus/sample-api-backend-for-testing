<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class BookResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $requestedFields = $request->has('fields')
            ? explode(',', $request->query('fields'))
            : null;

        $book = collect([
            'id' => $this->id,
            'title' => $this->title,
            'author' => $this->author,
            'isbn' => $this->isbn,
            'genre' => $this->genre, 
            'publication_year' => $this->publication_year, 
            'publisher' => $this->publisher, 
            'pages' => $this->pages, 
            'language' => $this->language, 
            'summary' => $this->summary, 
            'rating_avg' => $this->rating_avg,
            'number_of_reviews' => $this->number_of_reviews,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ]);

        if ($requestedFields !== null) {
            $book = $book->only($requestedFields);
        }

        $book = $book->filter(fn($value) => $value !== null);

        return $book->all();
    }
}
