<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

<<<<<<< HEAD
    
    class Order extends Model
    {
        public function pizzas()
        {
            return $this->belongsToMany(Pizza::class)->withPivot('toppings', 'size', 'price');
        }
    }
=======
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
>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
