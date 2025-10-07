<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_name' => 'string|max:255',
            'book_author_name' => 'string|max:255',
            'book_price' => 'numeric',
            'book_stock' => 'integer',
            'book_status' => 'boolean',
        ];
    }
}
