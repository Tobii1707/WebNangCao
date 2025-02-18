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
        // Lấy sản phẩm từ cơ sở dữ liệu
        $product = Product::find($productId);

        if ($product) {
            // Lấy user hiện tại
            $userId = Auth::id();

            // Kiểm tra sản phẩm đã có trong giỏ hàng hay chưa
            $cartItem = CartItem::where('user_id', $userId)
                ->where('product_id', $productId)
                ->first();

            if ($cartItem) {
                // Nếu có, tăng số lượng sản phẩm
                $cartItem->quantity += $request->input('quantity', 1);
                $cartItem->save();
            } else {
                
                // Nếu chưa có, tạo mới mục giỏ hàng
                CartItem::create([
                    'user_id' => $userId,
                    'product_id' => $productId,
                    'quantity' => $request->input('quantity', 1),
                ]);
            }

            // Quay lại trang giỏ hàng với thông báo thành công
            return redirect()->route('cart.index')->with('success', 'Product added to cart.');
        }

        // Nếu sản phẩm không tồn tại, quay lại trang sản phẩm với thông báo lỗi
        return redirect()->route('products.index')->with('error', 'Product not found.');
    }

    // Hiển thị giỏ hàng
    public function index()
    {
        $userId = Auth::id();
        $cartItems = CartItem::where('user_id', $userId)
            ->with('product') // Sử dụng quan hệ để lấy thông tin sản phẩm
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

    // Lặp qua từng mục giỏ hàng và cập nhật số lượng
    foreach ($request->input('cart', []) as $cartItemId => $data) {
        $cartItem = CartItem::where('user_id', $userId)
            ->where('id', $cartItemId)
            ->first();

        if ($cartItem) {
            // Cập nhật số lượng
            $cartItem->quantity = $data['quantity'];
            $cartItem->save();
        }
    }

    return redirect()->route('cart.index')->with('success', 'Cart updated successfully!');
}

}
