<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Welcome to Pizza Site</title>
    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,600&display=swap" rel="stylesheet" />

    <!-- Styles -->
    <style>
        body {
            font-family: 'Figtree', sans-serif;
            margin: 0;
            padding: 0;
            background-color: #fff;
            color: #333;
        }
        .header {
            background-color: #ff4500;
            color: white;
            padding: 20px;
            text-align: center;
            position: relative;
        }
        .content {
            text-align: center;
            padding: 50px 20px;
        }
        .auth-buttons {
            position: absolute;
            top: 20px;
            right: 20px;
        }
        .auth-buttons a {
            color: white;
            text-decoration: none;
            padding: 8px 15px;
            margin-left: 10px;
            background-color: #333;
            border-radius: 5px;
        }
        .auth-buttons a:hover {
            background-color: #555;
        }
        .footer {
            background-color: #333;
            color: white;
            padding: 10px 20px;
            text-align: center;
        }
        ul {
            list-style-type: none;
            padding: 0;
        }
        li {
            border-bottom: 1px solid #ccc;
            padding: 10px;
            text-align: left;
        }
        #order-form {
            margin-bottom: 30px;
        }
        #order-form label {
            display: block;
            margin-bottom: 10px;
        }
        #order-form select, #delivery-type {
            width: 100%;
            padding: 8px;
            margin-bottom: 15px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-sizing: border-box;
        }
        #order-form button {
            background-color: #ff4500;
            color: white;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
        }
        #order-summary {
            text-align: center;
        }
        #order-summary ul {
            padding: 0;
            margin-bottom: 20px;
        }
        #order-summary li {
            margin-bottom: 10px;
        }
        #order-summary p {
            font-size: 18px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="header">
        Welcome to the Pizza Site
       
    </div>

    <div id="order-summary">
        <h2>Order Summary</h2>
        <p>Current Pizza Total: £<span id="current-total">0</span></p>
        <ul id="order-list"></ul>
        <p>Total: £<span id="total">0</span></p>
        <button type="button" onclick="placeOrder()">Place Order</button>
    </div>
    <div class="content">
        <form id="order-form" action="/store-order" method="POST">
            @csrf
            <label>Select Pizza:</label>
            <select id="pizza-select">
                <option value="" disabled selected>Choose a pizza</option>
                @foreach ($pizzas as $pizza)
                    <option value="{{ $pizza->id }}">{{ $pizza->name }} Small - £{{ $pizza->s_price }}</option>
                    <option value="{{ $pizza->id }}">{{ $pizza->name }} Medium - £{{ $pizza->m_price }}</option>
                    <option value="{{ $pizza->id }}">{{ $pizza->name }} Large - £{{ $pizza->l_price }}</option>
                @endforeach
            </select>

            <label for="topping-select">Select Extra Toppings (85p each):</label>
            <ul id="topping-select">
                @foreach ($toppings as $topping)
                    <li><input type="checkbox" name="toppings[]" value="{{ $topping->id }}">{{ $topping->name }}</li>
                @endforeach
            </ul>

            <label for="delivery-type">Delivery or Collection:</label>
            <select id="delivery-type">
                <option value="collection">Collection</option>
                <option value="delivery">Delivery (+£5)</option>
            </select>

            <button type="button" onclick="addToOrder()">Add to Order</button>
            <button type="button" onclick="placeOrder()">Submit Order</button>
        </form>
    </div>



    <div class="footer">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>

    <script>
        let order = [];
        let total = 0;

        function addEventListeners() {
            const pizzaSelect = document.getElementById('pizza-select');
            const toppingCheckboxes = document.querySelectorAll('#topping-select input[type="checkbox"]');
            const deliveryType = document.getElementById('delivery-type');

            pizzaSelect.addEventListener('change', updateOrderSummary);
            toppingCheckboxes.forEach(checkbox => {
                checkbox.addEventListener('change', updateOrderSummary);
            });
            deliveryType.addEventListener('change', updateOrderSummary);
        }

        function updateOrderSummary() {
            const pizzaId = document.getElementById('pizza-select').value;
            const pizzaName = document.getElementById('pizza-select').options[document.getElementById('pizza-select').selectedIndex].text;
            const toppings = Array.from(document.querySelectorAll('#topping-select input[type="checkbox"]:checked')).map(checkbox => checkbox.nextSibling.textContent);
            const deliveryType = document.getElementById('delivery-type').value;
            const deliveryCost = deliveryType === 'delivery' ? 5 : 0;
            const pizzaPrice = parseFloat(pizzaName.split(' - £')[1] || 0);

            const toppingCost = toppings.length * 0.85;
            const currentTotalPrice = pizzaPrice + toppingCost + deliveryCost;

            // Update current total displayed
            document.getElementById('current-total').textContent = currentTotalPrice.toFixed(2);
        }

        function addToOrder() {
            const pizzaId = document.getElementById('pizza-select').value;
            const pizzaName = document.getElementById('pizza-select').options[document.getElementById('pizza-select').selectedIndex].text;
            const toppings = Array.from(document.querySelectorAll('#topping-select input[type="checkbox"]:checked')).map(checkbox => checkbox.nextSibling.textContent);
            const deliveryType = document.getElementById('delivery-type').value;
            const deliveryCost = deliveryType === 'delivery' ? 5 : 0;
            const pizzaPrice = parseFloat(pizzaName.split(' - £')[1] || 0);

            const toppingCost = toppings.length * 0.85;
            const totalPrice = pizzaPrice + toppingCost + deliveryCost;

            order.push({
                pizzaId,
                pizzaName,
                toppings,
                pizzaPrice,
                toppingCost,
                deliveryType,
                deliveryCost,
                totalPrice
            });

            total += totalPrice;

            // Update total and reset form inputs
            document.getElementById('total').textContent = total.toFixed(2);
            document.getElementById('pizza-select').selectedIndex = 0;
            document.querySelectorAll('#topping-select input[type="checkbox"]').forEach(checkbox => checkbox.checked = false);
            document.getElementById('delivery-type').selectedIndex = 0;
            document.getElementById('current-total').textContent = "0";
        }

        function placeOrder() {
            fetch('/store-order', {
                method: 'POST',
                headers: {
                    'Accept': 'application/json',
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({ order: order, total: total })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    console.log('Order placed successfully');
                    window.location.href = '/cart';
                } else {
                    console.error('Failed to place order');
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        }

        document.addEventListener('DOMContentLoaded', function () {
            addEventListeners();
        });
    </script>
</body>
</html>