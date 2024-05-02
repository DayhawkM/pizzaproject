<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Pizza;

class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Add Margherita
        Pizza::create([
            'name' => 'Margherita',
            'toppings' => 'Cheese, tomato sauce',
            's_price' => 8,
            'm_price' => 9,
            'l_price' => 12,
        ]);

        // Add Gimme the Meat
        Pizza::create([
            'name' => 'Gimme the Meat',
            'toppings' => 'Pepperoni, ham, chicken, minced beef, sausage, bacon',
            's_price' => 11,
            'm_price' => 14.50,
            'l_price' => 16.50,
        ]);

        // Add Veggie Delight
        Pizza::create([
            'name' => 'Veggie Delight',
            'toppings' => 'Onions, green peppers, mushrooms, sweetcorn',
            's_price' => 10,
            'm_price' => 13,
            'l_price' => 15,
        ]);

        // Add Make Mine Hot
        Pizza::create([
            'name' => 'Make Mine Hot',
            'toppings' => 'Chicken, onions, green peppers, jalapeno peppers',
            's_price' => 11,
            'm_price' => 13,
            'l_price' => 15,
        ]);
    }
}