<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id', 'pizza_id', 'size', 'toppings', 'delivery_type', 'total_price'];

    // Order belongs to a User
    public function user() {
        return $this->belongsTo(User::class);
    }

    // Order is related to a Pizza
    public function pizza() {
        return $this->belongsTo(Pizza::class);
    }
}