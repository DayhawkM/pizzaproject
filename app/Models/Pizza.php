<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
<<<<<<< HEAD
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('toppings', 'size', 'price');
    }
    protected $fillable = ['name', 'toppings', 's_price', 'm_price', 'l_price'];
=======
    protected $fillable = ['name', 's_price', 'm_price', 'l_price'];

    // A pizza can be in many orders
    public function orders() {
        return $this->hasMany(Order::class);
    }
>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
}