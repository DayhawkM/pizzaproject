<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    protected $fillable = ['name', 's_price', 'm_price', 'l_price'];

    // A pizza can be in many orders
    public function orders() {
        return $this->hasMany(Order::class);
    }
}