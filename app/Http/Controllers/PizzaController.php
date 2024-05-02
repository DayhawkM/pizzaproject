<?php

namespace App\Http\Controllers;

use App\Models\Pizza;
use Illuminate\Http\Request;
use App\Models\Topping;

class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pizzas = \App\Models\Pizza::all(); 
        $toppings = Topping::all(); 
        return view('welcome', compact('pizzas', 'toppings')); 
    }

    public function dashboard()
{
    $pizzas = \App\Models\Pizza::all(); 
    $toppings = Topping::all(); 
    return view('dashboard', compact('pizzas', 'toppings')); // Pass the 'pizzas' and 'toppings' variables to the dashboard view
}

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(Pizza $pizza)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Pizza $pizza)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Pizza $pizza)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Pizza $pizza)
    {
        //
    }
}
