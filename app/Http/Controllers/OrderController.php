<?php

<<<<<<< HEAD
use Illuminate\Http\Request;
=======
namespace App\Http\Controllers;

>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
use App\Models\Order;
use Illuminate\Http\Request;

class OrderController extends Controller
{
<<<<<<< HEAD
    public function addToOrder(Request $request) {
        // Retrieve current order from session or initialize a new one
        $order = session()->get('order', []);

        // Add new item to the order
        array_push($order, $request->all());

        // Update session
        session(['order' => $order]);

        return response()->json(['success' => true]);
    }

    public function storeOrder(Request $request) {
        $orderDetails = $request->input('order');
        $totalPrice = $request->input('total');

        $order = new Order();
        $order->user_id = auth()->id();  // Assuming you are handling authentication
        $order->details = json_encode($orderDetails);
        $order->total_price = $totalPrice;
        $order->save();

        // Store order in session to display in the cart
        session(['cart' => $order]);

        return response()->json(['success' => true]);
=======
    public function index()
    {
        $orders = Order::with('user', 'pizza')->get(); // Make sure relationships are defined in the models
        return view('orders', ['orders' => $orders]);
>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
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