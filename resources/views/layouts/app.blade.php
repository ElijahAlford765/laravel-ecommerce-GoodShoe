<!DOCTYPE html>
<html>
<head>
    <title>GoodShoe</title>
</head>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

<body>
    <nav>
        <a href="{{ route('shop.index') }}">Home</a> | 
        <a href="{{ route('cart.index') }}">Cart</a> |
        
<a href="{{ route('admin.products.index') }}">Admin</a> |
<a href="{{ route('orders.index') }}">Orders</a>

    </nav>
    <hr>
    @yield('content')
</body>
</html>
