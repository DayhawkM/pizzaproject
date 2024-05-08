<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
<<<<<<< HEAD
            $table->float('total_price');
            $table->enum('delivery_type', ['collection', 'delivery']);
=======
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->foreignId('pizza_id')->constrained()->onDelete('cascade');
            $table->string('size');
            $table->text('toppings');
            $table->string('delivery_type');
            $table->decimal('total_price', 10, 2);
>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
}