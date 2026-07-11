<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTransactionRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'transaction_number' => 'nullable|string|max:50',
            'transaction_date' => 'required|date',
            'merchant_code' => 'required|string|max:50',
            'product_id' => 'required|exists:products,id',
            'qty' => 'required|integer|min:1',
            'price' => 'required|numeric|min:0',
            'subtotal' => 'nullable|numeric|min:0',
        ];
    }
}
