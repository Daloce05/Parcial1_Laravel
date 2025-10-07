<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'book_name' => 'required|string|max:255',
            'book_author_name' => 'required|string|max:255',
            'book_price' => 'required|numeric',
            'book_stock' => 'required|integer',
            'book_status' => 'boolean',
        ];
    }
}
