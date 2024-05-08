<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

    
    class Order extends Model
    {
        public function pizzas()
        {
            return $this->belongsToMany(Pizza::class)->withPivot('toppings', 'size', 'price');
        }
    }
