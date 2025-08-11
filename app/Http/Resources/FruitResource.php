<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class FruitResource extends JsonResource
{
    public function toArray(Request $request): array
    {
        $requestedFields = $request->has('fields')
            ? explode(',', $request->query('fields'))
            : null;

        $fruit = collect([
            'id' => $this->id,
            'name' => $this->name,
            'scientific_name' => $this->scientific_name,
            'color' => $this->color,
            'taste_profile' => $this->taste_profile,
            'season' => $this->season,
            'is_seasonal' => $this->is_seasonal,
            'price_per_kg' => $this->price_per_kg,
            'origin_country' => $this->origin_country,
            'description' => $this->description,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ]);

        if ($requestedFields !== null) {
            $fruit = $fruit->only($requestedFields);
        }

        $fruit = $fruit->filter(fn($value) => $value !== null);

        return $fruit->all();
    }
}

