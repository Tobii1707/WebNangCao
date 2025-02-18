<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product List - Shopee Style</title>
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
<header class="header">
    <div class="logo">
        <a href="/">Shopee</a>
    </div>
    <div class="search-bar">
        <input type="text" placeholder="Search for products...">
        <button>Search</button>
    </div>

    <!-- Biểu tượng giỏ hàng -->
    <div class="cart-icon">
    <a href="{{ route('cart.index') }}">
        🛒
        <!-- Hiển thị số lượng sản phẩm trong giỏ hàng nếu người dùng đã đăng nhập -->
        <span class="cart-count">
            @auth
                {{ Auth::user()->cartItems->sum('quantity') }}
            @else
                0
            @endauth
        </span>
    </a>
</div>


    <!-- Biểu tượng người dùng và đăng xuất -->
    <div class="user-icon">
        @auth
            <!-- Hiển thị tên người dùng và nút đăng xuất -->
            <span>{{ Auth::user()->name }}</span>
            <form action="{{ route('logout') }}" method="POST" style="display:inline;">
                @csrf
                <button type="submit" class="logout-button">Logout</button>
            </form>
        @else
            <!-- Nếu chưa đăng nhập, hiển thị icon người dùng -->
            <a href="{{ route('login') }}">
                👤
            </a>
        @endauth
    </div>
</header>

<main class="main-content">
    <aside class="sidebar">
        <h3>Categories</h3>
        <ul>
            <li><a href="#">Electronics</a></li>
            <li><a href="#">Clothing</a></li>
            <li><a href="#">Beauty</a></li>
            <li><a href="#">Home Appliances</a></li>
        </ul>
    </aside>

    <section class="product-list">
        <h2>Featured Products</h2>

        <div class="product-cards">
            @foreach ($products as $product)
                <div class="product-card">
                    <img src="{{ asset('images/'.$product->image) }}" alt="{{ $product->name }}">
                    <h3>{{ $product->name }}</h3>
                    <p class="price">${{ $product->price }}</p>

                    <!-- Form để thêm sản phẩm vào giỏ hàng và chọn số lượng -->
                    <form action="{{ route('cart.add', $product->id) }}" method="POST">
                        @csrf
                        <input type="number" name="quantity" value="1" min="1">
                        <button type="submit" class="add-to-cart-button">Add to Cart</button>
                    </form>
                </div>
            @endforeach
        </div>
    </section>
</main>

<footer class="footer">
    <p>&copy; 2025 Shopee Clone - All rights reserved</p>
</footer>
</body>
</html>
