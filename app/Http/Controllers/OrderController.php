<?php

use Illuminate\Http\Request;
use App\Models\Order;

class OrderController extends Controller
{
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
    }
}