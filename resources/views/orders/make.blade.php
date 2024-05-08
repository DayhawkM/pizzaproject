{{-- resources/views/orders/make.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="header">
    <h1>Create Your Order</h1>
</div>

<div class="content">
    <form id="order-form" method="POST" action="{{ route('orders.store') }}">
        @csrf
        <label>Select Pizza:</label>
        <select id="pizza-select" name="pizza_id">
            <option value="" disabled selected>Choose a pizza</option>
            @foreach ($pizzas as $pizza)
                <option value="{{ $pizza->id }}">
                    {{ $pizza->name }} - Prices: Small £{{ $pizza->s_price }}, Medium £{{ $pizza->m_price }}, Large £{{ $pizza->l_price }}
                </option>
            @endforeach
        </select>

        <label for="topping-select">Select Extra Toppings (85p each):</label>
        <div id="topping-select">
            @foreach ($toppings as $topping)
                <div>
                    <input type="checkbox" name="toppings[]" value="{{ $topping->id }}">
                    <label>{{ $topping->name }}</label>
                </div>
            @endforeach
        </div>

        <label for="delivery-type">Delivery or Collection:</label>
        <select id="delivery-type" name="delivery_type">
            <option value="collection">Collection</option>
            <option value="delivery">Delivery (+£5)</option>
        </select>

        <button type="submit">Submit Order</button>
    </form>
</div>
@endsection