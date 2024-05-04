<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::with('user', 'pizza')->get(); // Make sure relationships are defined in the models
        return view('orders', ['orders' => $orders]);
    }
    public function store(Request $request)
{
    $validated = $request->validate([
        'pizza_id' => 'required|integer',
        'size' => 'required|string',
        'toppings' => 'required|array',
        'delivery_type' => 'required|string',
        'total_price' => 'required|numeric',
    ]);

    $order = Order::create([
        'user_id' => auth()->id(), // assuming users are logged in to place orders
        'pizza_id' => $validated['pizza_id'],
        'size' => $validated['size'],
        'toppings' => json_encode($validated['toppings']), // storing toppings as JSON
        'delivery_type' => $validated['delivery_type'],
        'total_price' => $validated['total_price'],
    ]);

    return response()->json(['message' => 'Order successfully created', 'order' => $order]);
}
}