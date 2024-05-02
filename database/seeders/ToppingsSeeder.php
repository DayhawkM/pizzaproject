<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Topping;

class ToppingsSeeder extends Seeder
{
    public function run()
    {
        $toppings = [
            'Cheese', 'Tomato sauce', 'Pepperoni', 'Ham', 'Chicken', 'Minced beef', 
            'Sausage', 'Bacon', 'Onions', 'Green peppers', 'Mushrooms', 'Sweetcorn', 
            'Jalapeno peppers', 'Vegan cheese', 'Pineapple', 'Salami', 'Olives', 
            'Spicy beef', 'Hot dog pieces'
        ];

        foreach ($toppings as $topping) {
            Topping::create(['name' => $topping]);
        }
    }
}