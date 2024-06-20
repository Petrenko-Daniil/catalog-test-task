<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class OrdersController extends Controller
{
    public function index()
    {
        $orders = Order::where('total_price', '!=', 0)->get();
        $orders->load('products');
        return Inertia::render('Admin/Orders', [
            'orders' => $orders,
            'ordersTotalPrice' => $orders->sum('total_price'),
            'ordersOpenTotalPrice' => $orders->where('status', 'open')->sum('total_price'),
            'ordersConfirmedTotalPrice' => $orders->where('status', 'confirmed')->sum('total_price'),
        ]);
    }
}
