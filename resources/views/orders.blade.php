<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Orders</title>
</head>
<body>
    <h1>All Orders</h1>
    <table>
        <thead>
            <tr>
                <th>Order ID</th>
                <th>User</th>
                <th>Pizza</th>
                <th>Size</th>
                <th>Toppings</th>
                <th>Delivery Type</th>
                <th>Total Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
            <tr>
                <td>{{ $order->id }}</td>
                <td>{{ optional($order->user)->name ?? 'N/A' }}</td>
                <td>{{ optional($order->pizza)->name ?? 'N/A' }}</td>
                <td>{{ $order->size }}</td>
                <td>{{ implode(', ', json_decode($order->toppings, true)) }}</td>
                <td>{{ $order->delivery_type }}</td>
                <td>£{{ number_format($order->total_price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>