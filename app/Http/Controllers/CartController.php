<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    // Thêm sản phẩm vào giỏ hàng
    public function add(Request $request, $productId)
    {
        $product = Product::find($productId);

        if (!$product) {
            return redirect()->route('products.index')->with('error', 'Product not found.');
        }

        $userId = Auth::id();
        $cartItem = CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->first();

        if ($cartItem) {
            $cartItem->quantity += $request->input('quantity', 1);
            $cartItem->save();
        } else {
            CartItem::create([
                'user_id' => $userId,
                'product_id' => $productId,
                'quantity' => $request->input('quantity', 1),
            ]);
        }

        return redirect()->route('cart.index')->with('success', 'Product added to cart.');
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();
        $cartItems = CartItem::where('user_id', $userId)
            ->with('product')
            ->get();

        return view('cart.index', compact('cartItems'));
    }

    // Xóa sản phẩm khỏi giỏ hàng
    public function remove($productId)
    {
        $userId = Auth::id();

        CartItem::where('user_id', $userId)
            ->where('product_id', $productId)
            ->delete();

        return redirect()->route('cart.index')->with('success', 'Product removed from cart.');
    }

    // Cập nhật số lượng sản phẩm trong giỏ hàng
    public function update(Request $request)
    {
        $userId = Auth::id();

        foreach ($request->input('cart', []) as $cartItemId => $data) {
            $cartItem = CartItem::where('user_id', $userId)
                ->where('id', $cartItemId)
                ->first();

            if ($cartItem) {
                $cartItem->quantity = max(1, (int) $data['quantity']); // Đảm bảo số lượng không nhỏ hơn 1
                $cartItem->save();
            }
        }

        return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
    }

    // Xóa toàn bộ giỏ hàng
    public function clear()
    {
        $userId = Auth::id();
        CartItem::where('user_id', $userId)->delete();

        return redirect()->route('cart.index')->with('success', 'Cart cleared successfully!');
    }
}
