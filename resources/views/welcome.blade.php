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
    </style>
</head>
<body class="antialiased">
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

    <div class="content">
        <h1>Enjoy Our Delicious Pizza</h1>
        <p>Discover a variety of pizzas made with fresh ingredients and love!</p>
        <h1>Current Pizzas</h1>
        <ul>
            @foreach ($pizzas as $pizza)
<<<<<<< HEAD
                <li>{{ $pizza->name }} - {{ $pizza->toppings}} - Small £{{ $pizza->s_price}} - Medium £{{ $pizza->m_price}} - Large £{{ $pizza->l_price}}</li>
=======
                <li>{{ $pizza->name }} - {{ $pizza->toppings}} - Small: £{{ $pizza->s_price}} - Medium: £{{ $pizza->m_price}} - Large: £{{ $pizza->l_price}}</li>
>>>>>>> e6d872f13f7c30306392bb733c5a4defab643d8c
            @endforeach
        </ul>
        <h1> Current Toppings</h1>
        <ul>
            @foreach ($toppings as $topping)
                <li>{{$topping->name}}</li>
            @endforeach
    </div>

    <div class="footer">
        Laravel v{{ Illuminate\Foundation\Application::VERSION }} (PHP v{{ PHP_VERSION }})
    </div>
</body>
</html>