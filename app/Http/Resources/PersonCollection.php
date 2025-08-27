<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\ResourceCollection;

class PersonCollection extends ResourceCollection
{
    /**
     * Transform the resource collection into an array.
     *
     * @return array<int|string, mixed>
     */
    public $collects = PersonResource::class;

    public function toArray(Request $request): array
    {
        $data = parent::toArray($request);

        if ($this->resource instanceof \Illuminate\Pagination\LengthAwarePaginator) {
            // Laravel's default already has 'meta' and 'links'
            return [
                'data' => $data,
                'meta' => [
                    'total' => $this->total(), // Total number of items in the collection
                    'count' => $this->count(), // Number of items in the current page
                    'per_page' => $this->perPage(), // Number of items per page
                    'current_page' => $this->currentPage(), // Current page number
                    'total_pages' => $this->lastPage(), // Total number of pages
                ]
            ];
        }

        // Non-paginated: just use count
        return [
            'data' => $data
        ];
    }
}
