<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Auth;
class BookRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        if ($this->routeIs('book.store')) {
            return Auth::check();
        }
        if ($this->routeIs('book.update')) {
            return Auth::check();
        }
        if ($this->routeIs('book.view')) {
            return true;
        }
        if ($this->routeIs('books.view')) {
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
        if ($this->routeIs('book.store')) {
            return $this->storeBook();
        }
        if ($this->routeIs('book.update')) {
            return $this->storeBook();
        }
        return array_merge(
            []
        );
    }

    private function storeBook(): array
    {
        return [
            'title' => [
                'required',
                'string',
                'max:255',
            ],
            'author' => [
                'required',
                'string',
                'max:255',
            ],
            'isbn' => [
                'required',
                'string',
                'max:20',
            ],
            'genre' => [
                'required',
                'string',
                'max:100',
            ],
            'publication_year' => [
                'required',
                'integer',
                'between:0,9999',
            ],
            'publisher' => [
                'required',
                'string',
                'max:255',
            ],
            'pages' => [
                'required',
                'integer',
                'between:0,99999',
            ],
            'language' => [
                'required',
                'string',
                'max:100',
            ],
            'summary' => [
                'required',
                'string',
                'max:2500',
            ],
            'rating_avg' => [
                'required',
                'integer',
                'between:0,10',
            ],
            'number_of_reviews' => [
                'required',
                'integer',
                'between:0,99999',
            ],
        ];
    }
}
