<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;

class FruitRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        // Change Profile Picture
        if ($this->routeIs('fruit.store')) {
            return Auth::check();
        }
        if ($this->routeIs('fruit.update')) {
            return Auth::check();
        }
        if ($this->routeIs('fruit.view')) {
            return true;
        }
        if ($this->routeIs('fruits.view')) {
            return true;
        }
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        // Change Profile Picture
        if ($this->routeIs('fruit.store')) {
            return $this->storeFruit();
        }
        if ($this->routeIs('fruit.update')) {
            return $this->storeFruit();
        }
        return array_merge(
            []
        );
    }


    private function storeFruit(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'scientific_name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'color' => [
                'required',
                'string',
                'max:50',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'taste_profile' => [
                'required',
                'string',
                'max:100',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'season' => [
                'required',
                'string',
                'max:50',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'is_seasonal' => [
                'required',
                'boolean',
                ],
            'price_per_kg' => [
                'required',
                'decimal:8,2',
                ],
            'origin_country' => [
                'required',
                'string',
                'max:100',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
                ],
            'description' => [
                'required',
                'string',
                'max:1000',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ]
        ];
    }


}
