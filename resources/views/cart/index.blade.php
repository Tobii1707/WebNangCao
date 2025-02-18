<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Shopping Cart - Shopee Style</title>
    <link rel="stylesheet" href="{{ asset('css/cart-style.css') }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
    <div class="cart-content">
        <h2>Your Cart</h2>
        
        @php
            // Lấy tất cả sản phẩm trong giỏ của người dùng đã đăng nhập
            $cartItems = Auth::user()->cartItems;
        @endphp

        @if(count($cartItems) > 0)
            <form action="{{ route('cart.update') }}" method="POST">
                @csrf
                @method('PUT')
                <table class="cart-table">
                    <thead>
                        <tr>
                            <th>Image</th>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($cartItems as $item)
                            <tr>
                                <td><img src="{{ asset('images/'.$item->product->image) }}" alt="{{ $item->product->name }}"></td>
                                <td>{{ $item->product->name }}</td>
                                <td>${{ $item->product->price }}</td>
                                <td>
                                    <input type="number" name="cart[{{ $item->id }}][quantity]" value="{{ $item->quantity }}" min="1">
                                </td>
                                <td>${{ $item->product->price * $item->quantity }}</td>
                                <td>
                                    <form action="{{ route('cart.remove', $item->product_id) }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="remove-button">
                                            <i class="fas fa-trash-alt"></i> Remove
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="cart-total">
                    <p>Total: ${{ $cartItems->sum(fn($item) => $item->product->price * $item->quantity) }}</p>
                    <button type="submit" class="update-button">
                        <i class="fas fa-sync-alt"></i> Update Cart
                    </button>
                </div>

                <div class="back-button">
                    <a href="{{ route('products.index') }}" class="back-btn">Back to Shopping</a>
                </div>
            </form>

            <div class="checkout-button">
                <a href="#" class="checkout-btn">Proceed to Checkout</a>
            </div>

        @else
            <p>Your cart is empty.</p>
        @endif
    </div>
</body>
</html>
