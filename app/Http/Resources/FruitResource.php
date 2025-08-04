<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        // Get the requested fields from the 'fields' query parameter.
        // If 'fields' parameter is not present, $requestedFields will be an empty array.
        $requestedFields = $request->has('fields')
            ? explode(',', $request->query('fields'))
            : [];

        /**
         * Helper function to determine if a field should be included in the response.
         *
         * @param string $fieldToCheck The name of the field to check against the 'fields' query parameter.
         * This should match the name you expect in the query string.
         * @return bool
         */
        $shouldInclude = function (string $fieldToCheck) use ($requestedFields, $request) {
            // If the 'fields' query parameter is NOT present, include all fields.
            if (!$request->has('fields')) {
                return true;
            }
            // If the 'fields' query parameter IS present, only include the field
            // if it is explicitly listed in the requested fields.
            return in_array($fieldToCheck, $requestedFields);
        };

        // Build the response array for the 'user' object.
        // We use the `when()` method with our `shouldInclude` helper.
        // The keys here ('id', 'name', 'role', 'email') are the actual output keys in your JSON.
        $fruit = [
            'id' => $this->when($shouldInclude('id'), $this->id),
            'name' => $this->when($shouldInclude('name'), $this->name),
            'scientific_name' => $this->when($shouldInclude('scientific_name'), $this->scientific_name),
            'color' => $this->when($shouldInclude('color'), $this->color),
            'taste_profile' => $this->when($shouldInclude('taste_profile'), $this->taste_profile), 
            'season' => $this->when($shouldInclude('season'), $this->season), 
            'is_seasonal' => $this->when($shouldInclude('is_seasonal'), $this->is_seasonal), 
            'price_per_kg' => $this->when($shouldInclude('price_per_kg'), $this->price_per_kg), 
            'origin_country' => $this->when($shouldInclude('origin_country'), $this->origin_country), 
            'description' => $this->when($shouldInclude('description'), $this->description),
            // 'created_at' => $this->when($shouldInclude('created_at'), $this->created_at->toDateTimeString()),
            // 'updated_at' => $this->when($shouldInclude('updated_at'), $this->updated_at->toDateTimeString()),
        ];

        // If the 'fields' parameter was present, `when()` might return `null` for non-included fields.
        // We use `array_filter` to remove these `null` entries, ensuring that fields not requested
        // are completely absent from the JSON, rather than present with a `null` value.
        // We only apply this filtering if the 'fields' parameter was actually provided by the client.
        if ($request->has('fields')) {
            $fruit = array_filter($fruit, fn ($value) => $value !== null);
        }

        return $fruit;
    }


}
