{{-- resources/views/orders/show.blade.php --}}
@extends('layouts.app')

@section('content')
    <h1>Order Details</h1>
    <p><strong>Total Price:</strong> £{{ number_format($order->total_price, 2) }}</p>
    <p><strong>Delivery Type:</strong> {{ $order->delivery_type }}</p>
    <ul>
        @foreach ($order->pizzas as $pizza)
            <li>{{ $pizza->name }} - Size: {{ $pizza->pivot->size }} - Price: £{{ number_format($pizza->pivot->price, 2) }}
                <ul>
                    @foreach (json_decode($pizza->pivot->toppings, true) as $topping)
                        <li>{{ $topping }}</li>
                    @endforeach
                </ul>
            </li>
        @endforeach
    </ul>
@endsection