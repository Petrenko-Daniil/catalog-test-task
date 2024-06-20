<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Http\Request;

class OrdersController extends Controller
{
    public function buy(Request $request, Product $product){
        $request->validate([
            'amount' => 'required|int',
            'session_id' => 'required|string'
        ]);
        $sessionId = $request->get('session_id');
        $order = Order::where('session_id', $sessionId)->where('status', 'open')->first();
        $amount = $request->get('amount');
        if (!$order){
            $order = new Order();
            $order->total_price = 0;
            $order->session_id = $sessionId;
            $order->save();
        }
        $order->products()->attach([
            $product->id => [
                'amount' => $amount
            ]
        ]);
        $order->updateTotalPrice();
        return response()->json([
            'status' => 'green',
            'msg' => 'Product was successfully added to your basket'
        ]);
    }

    public function confirm(Request $request, Order $order){
        $order->update([
            'status' => 'confirmed'
        ]);
        return response()->json([
            'status' => 'green',
            'msg' => 'Our managers will contact you soon'
        ]);
    }
}
