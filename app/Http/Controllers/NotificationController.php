<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;

class NotificationController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::whereColumn('stock', '<', 'minimum_stock')->get();

        return response()->json([
            'count' => $products->count(),
            'items' => $products->map(fn ($p) => [
                'product_name' => $p->product_name,
                'stock' => $p->stock,
                'minimum_stock' => $p->minimum_stock,
            ]),
        ]);
    }
}
