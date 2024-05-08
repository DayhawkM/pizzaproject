<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pizza extends Model
{
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('toppings', 'size', 'price');
    }
    protected $fillable = ['name', 'toppings', 's_price', 'm_price', 'l_price'];
}