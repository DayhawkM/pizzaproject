<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePizzasTable extends Migration
{
    public function up()
    {
        Schema::create('pizzas', function (Blueprint $table) {
            $table->id();
            // Add other columns here
            $table->decimal('s_price', 8, 2)->nullable();
            $table->decimal('m_price', 8, 2)->nullable();
            $table->decimal('l_price', 8, 2)->nullable();
            // Do not add 'toppings' column again here
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pizzas');
    }
}