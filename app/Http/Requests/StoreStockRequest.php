<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreStockRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'stock_code' => 'nullable|string|max:50',
            'stock_date' => 'required|date',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
        ];
    }
}
