<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PersonResource extends JsonResource
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

        $persons = collect([
            'id' => $this->id,
            'full_name' =>"{$this->first_name} {$this->last_name}",
            'email' => $this->email,
            'phone_number' => $this->phone_number,
            'gender' => $this->gender,
            'address' => $this->address,
            'city' => $this->city,
            'state' => $this->state,
            'zip_code' => $this->zip_code,
            'country' => $this->country,
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
