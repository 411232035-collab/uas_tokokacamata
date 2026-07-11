<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_code',
        'product_name',
        'category_id',
        'purchase_price',
        'selling_price',
        'stock',
        'minimum_stock',
        'photo_path',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getImageUrlAttribute(): ?string
    {
        if (! $this->photo_path) {
            return null;
        }

        if (str_starts_with($this->photo_path, 'http://') || str_starts_with($this->photo_path, 'https://')) {
            return $this->photo_path;
        }

        return asset('storage/' . $this->photo_path);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }

    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
