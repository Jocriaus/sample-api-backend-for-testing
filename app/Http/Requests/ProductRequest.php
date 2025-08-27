<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->routeIs('product.store')) {
            return Auth::check();
        }
        if ($this->routeIs('product.update')) {
            return Auth::check();
        }
        if ($this->routeIs('product.view')) {
            return true;
        }
        if ($this->routeIs('products.view')) {
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
        if ($this->routeIs('product.store')) {
            return $this->storeProduct();
        }
        if ($this->routeIs('product.update')) {
            return $this->storeProduct();
        }
        return array_merge(
            []
        );
    }


    private function storeProduct(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'category' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'description' => [
                'required',
                'string',
                'max:2500',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'price' => [
                'required',
                'numeric',
            ],
            'stock_quantity' => [
                'required',
                'integer',
                'min:0',
            ],
            'sku' => [
                'required',
                'string',
                'max:50',
                'unique:products,sku',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'is_available' => [
                'required',
                'boolean',
            ],
            'weight_kg' => [
                'required',
                'numeric',
            ],
            'dimensions_cm' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'manufacturer_id' => [
                'required',
                'integer',
                'exists:manufacturers,id',
            ],
            'release_date' => [
                'required',
                'date',
            ],
        ];
    }
}
