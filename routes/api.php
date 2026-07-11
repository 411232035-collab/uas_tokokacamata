<?php

use App\Http\Controllers\Api\DashboardController;
use App\Http\Controllers\NotificationController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', [DashboardController::class, 'index']);
Route::get('/products', function () {
    return response()->json(\App\Models\Product::all());
});
Route::get('/stocks', function () {
    return response()->json(\App\Models\Stock::with('product')->get());
});
Route::get('/transactions', function () {
    return response()->json(\App\Models\Transaction::with('product')->get());
});
Route::get('/reports', function () {
    return response()->json([
        'summary' => [
            'revenue' => \App\Models\Transaction::sum('subtotal'),
            'transactions' => \App\Models\Transaction::count(),
        ],
    ]);
});
Route::get('/notifications', [NotificationController::class, 'index']);
