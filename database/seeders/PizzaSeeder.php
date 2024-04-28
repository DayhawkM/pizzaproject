<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Pizza;


class PizzaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        Pizza::create([
            'name' => 'Pepperoni',
            'description' => 'Pepperoni and cheese on a rich tomato base.'
        ]);
    }
}