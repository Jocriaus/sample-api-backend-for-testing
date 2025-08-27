<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class PersonRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->routeIs('person.store')) {
            return Auth::check();
        }
        if ($this->routeIs('person.update')) {
            return Auth::check();
        }
        if ($this->routeIs('person.view')) {
            return true;
        }
        if ($this->routeIs('persons.view')) {
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
        if ($this->routeIs('person.store')) {
            return $this->storePerson();
        }
        if ($this->routeIs('person.update')) {
            return $this->storePerson();
        }
        return array_merge(
            []
        );
    }

    private function storePerson(): array
    {
        return [
            'first_name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'last_name' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'email' => [
                'required',
                'string',
                'email',
                'max:255',
                'unique:persons,email'
            ],
            'phone_number' => [
                'required',
                'string',
                'max:14',
            ],
            'gender' => [
                'required',
                'string',
                'max:255',
            ],
            'address' => [
                'required',
                'string',
                'max:255',
            ],
            'city' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'state' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'zip_code' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
            'country' => [
                'required',
                'string',
                'max:255',
                'not_regex:/[<>:"\/\\|?*\x00-\x1F\s.0-9]+$|^[<>:"\/\\|?*\x00-\x1F\s.0-9]+/', // Excludes leading/trailing spaces, periods, and numbers
            ],
        ];
    }
}
