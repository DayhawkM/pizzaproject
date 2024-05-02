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
<div class="header">
        Welcome to the Pizza Site
        @if (Route::has('login'))
            <div class="auth-buttons">
                @auth
                    <a href="{{ url('/dashboard') }}">Dashboard</a>
                    <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Log out</a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                @else
                    <a href="{{ route('login') }}">Log in</a>
                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>
<div id="order-summary">
            <h2>Order Summary</h2>
            <ul id="order-list">
                <!-- Order items will be dynamically added here -->
            </ul>
            <p>Total: £<span id="total">0</span></p>
            <button type="button" onclick="placeOrder()">Place Order</button>
        </div>
    <div class="content">
        <form id="order-form">
        <label>Select Pizza:</label>
<select id="pizza-select">
    <option value="" disabled selected>Choose a pizza</option>
    @foreach ($pizzas as $pizza)
        <option value="{{ $pizza->id }}">{{ $pizza->name }} Small - £{{ $pizza->s_price }}</option>
        <option value="{{ $pizza->id }}">{{ $pizza->name }} Medium - £{{ $pizza->m_price }}</option>
        <option value="{{ $pizza->id }}">{{ $pizza->name }} Large  - £{{ $pizza->l_price }}</option>
    @endforeach
</select>

            <label for="topping-select">Select Extra Toppings (85p each):</label>
            <ul id="topping-select" style="list-style-type: none; padding-left: 0;">
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
        </form>


    </div>

    <div class="footer">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>

    <script>
    let order = [];
    let total = 0;

    // Function to add event listeners
    function addEventListeners() {
        const pizzaSelect = document.getElementById('pizza-select');
        const toppingCheckboxes = document.querySelectorAll('#topping-select input[type="checkbox"]');
        const deliveryType = document.getElementById('delivery-type');

        // Add event listener for pizza selection
        pizzaSelect.addEventListener('change', updateOrderSummary);

        // Add event listener for topping selection
        toppingCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', updateOrderSummary);
        });

        // Add event listener for delivery type selection
        deliveryType.addEventListener('change', updateOrderSummary);
    }

    // Function to update order summary
    function updateOrderSummary() {
        const pizzaId = document.getElementById('pizza-select').value;
        const pizzaName = document.getElementById('pizza-select').options[document.getElementById('pizza-select').selectedIndex].text;
        const toppings = Array.from(document.querySelectorAll('#topping-select input[type="checkbox"]:checked')).map(checkbox => checkbox.nextSibling.textContent);
        const deliveryType = document.getElementById('delivery-type').value;
        const deliveryCost = deliveryType === 'delivery' ? 5 : 0;
        const pizzaPrice = parseFloat(pizzaName.split(' - £')[1]);

        const toppingCost = toppings.length * 0.85;
        const totalPrice = pizzaPrice + toppingCost + deliveryCost;

        total = totalPrice.toFixed(2);

        // Update total displayed
        document.getElementById('total').textContent = total;
    }

    // Function to add pizza to order
    function addToOrder() {
        const pizzaId = document.getElementById('pizza-select').value;
        const pizzaName = document.getElementById('pizza-select').options[document.getElementById('pizza-select').selectedIndex].text;
        const toppings = Array.from(document.querySelectorAll('#topping-select input[type="checkbox"]:checked')).map(checkbox => checkbox.nextSibling.textContent);
        const deliveryType = document.getElementById('delivery-type').value;
        const deliveryCost = deliveryType === 'delivery' ? 5 : 0;
        const pizzaPrice = parseFloat(pizzaName.split(' - £')[1]);

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

        updateOrderSummary();
    }

    // Function to place order
    function placeOrder() {
        // Send order data to server or handle it as needed
        console.log(order);
        console.log('Total:', total);
        // Reset order array and total
        order = [];
        total = 0;
        updateOrderSummary();
    }

    // Call addEventListeners function when the document is loaded
    document.addEventListener('DOMContentLoaded', function () {
        addEventListeners();
    });
</script>
</body>
</html>