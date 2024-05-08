{{-- cart.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Your Cart</h1>
    @if(session('cart'))
        <?php $order = session('cart'); ?>
        <div>
            <h2>Order Summary</h2>
            @foreach(json_decode($order->details, true) as $item)
                <p>Pizza: {{ $item['pizzaName'] }} - {{ $item['pizzaPrice'] }}</p>
                <p>Toppings: {{ implode(', ', $item['toppings']) }}</p>
                <p>Type: {{ $item['deliveryType'] }}</p>
                <p>Subtotal: £{{ $item['totalPrice'] }}</p>
            @endforeach
            <p>Total Price: £{{ $order->total_price }}</p>
        </div>
    @else
        <p>Your cart is empty!</p>
    @endif
</div>
@endsection