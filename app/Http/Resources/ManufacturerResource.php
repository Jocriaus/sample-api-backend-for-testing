<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ManufacturerResource extends JsonResource
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

        $manufacturer = collect([
            'id' => $this->id,
            'name' =>$this->name,
            'country_of_region' => $this->country_of_region,
            'website' => $this->website,
            'contact_email' => $this->contact_email,
            'founded_year' => $this->founded_year,
            // 'created_at' => $this->created_at->toDateTimeString(),
            // 'updated_at' => $this->updated_at->toDateTimeString(),
        ]);

        if ($requestedFields !== null) {
            $manufacturer = $manufacturer->only($requestedFields);
        }

        $manufacturer = $manufacturer->filter(fn($value) => $value !== null);

        return $manufacturer->all();
    }
}
