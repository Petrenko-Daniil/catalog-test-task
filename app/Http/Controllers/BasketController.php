<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Inertia\Inertia;

class BasketController extends Controller
{
    public function index()
    {
        $sessionId = session()->getId();
        $order = Order::where('session_id', $sessionId)->where('status', 'open')->first();
        if (!$order){
            $order = new Order();
            $order->total_price = 0;
            $order->session_id = $sessionId;
            $order->save();
        }
        $order->load('products');
        return Inertia::render('Customer/Basket', [
            'order' => $order
        ]);
    }
}
