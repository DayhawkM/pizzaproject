<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    
    public function storeOrder(Request $request)
    {
        // Validate the request data if needed
    
        $order = new Order();
        $order->pizza_id = $request->pizza_id;
        $order->toppings = $request->toppings;
        $order->delivery_type = $request->delivery_type;
        $order->total_price = $request->total_price;
    
        // Save the order
        $order->save();
    
        // Optionally, you can return a response indicating success or redirect the user
    }
    
}