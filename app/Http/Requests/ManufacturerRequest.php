<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class ManufacturerRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->routeIs('manufacturer.store')) {
            return Auth::check();
        }
        if ($this->routeIs('manufacturer.update')) {
            return Auth::check();
        }
        if ($this->routeIs('manufacturer.view')) {
            return true;
        }
        if ($this->routeIs('manufacturers.view')) {
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
        if ($this->routeIs('manufacturer.store')) {
            return $this->storeManufacturer();
        }
        if ($this->routeIs('manufacturer.update')) {
            return $this->storeManufacturer();
        }
        return array_merge(
            []
        );
    }

    private function storeManufacturer(): array
    {
        return [
            'name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'website' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'contact_email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:manufacturers,contact_email'
            ],
            'founded_year' => [
                'required',
                'integer',
                'min:1',
                'max:'.(new \DateTime())->format('Y'),
            ],
        ];
    }
}
