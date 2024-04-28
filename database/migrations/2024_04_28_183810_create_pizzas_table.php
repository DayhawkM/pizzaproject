<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->dropColumn('description'); // Drop the 'description' column
            $table->text('toppings'); // Add 'toppings' column
            $table->decimal('s_price', 8, 2); // Add 's-price' column
            $table->decimal('m_price', 8, 2); // Add 'm-price' column
            $table->decimal('l_price', 8, 2); // Add 'l-price' column
        });
    }

    public function down()
    {
        Schema::table('pizzas', function (Blueprint $table) {
            $table->text('description'); // Re-add the 'description' column if rolling back
            $table->dropColumn(['toppings', 's_price', 'm_price', 'l_price']);
        });
    }
};