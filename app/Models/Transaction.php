<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_number',
        'transaction_date',
        'merchant_code',
        'product_id',
        'qty',
        'price',
        'subtotal',
    ];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
