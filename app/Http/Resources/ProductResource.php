<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProductResource extends JsonResource
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
        $manufacturer = $this->manufacturers;
        $persons = collect([
            'name' => $this->name,
            'category' => $this->category,
            'description' => $this->description,
            'price' => $this->price,
            'stock_quantity' => $this->stock_quantity,
            'sku' => $this->sku,
            'is_available' => $this->is_available,
            'weight_kg' => $this->weight_kg,
            'dimensions_cm' => $this->dimensions_cm,
            'manufacturer' => [
                'id' => $manufacturer->id,
                'name' => $manufacturer->name,
                'country_of_origin' => $manufacturer->country_of_origin,
                'website' => $manufacturer->website,                
                'contact_email' => $manufacturer->contact_email,
                'founded_year' => $manufacturer->founded_year
            ],
            'release_date' => $this->release_date,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ]);

        if ($requestedFields !== null) {
            $persons = $persons->only($requestedFields);
        }

        $persons = $persons->filter(fn($value) => $value !== null);

        return $persons->all();
    }
}
