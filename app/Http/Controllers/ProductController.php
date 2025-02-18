<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $products = Product::all();  // Lấy tất cả sản phẩm
        return view('products.index', compact('products'));
    }

    // Hiển thị form tạo mới sản phẩm
    public function create()
    {
        return view('products.create');
    }

    // Xử lý lưu sản phẩm mới vào cơ sở dữ liệu
    public function store(Request $request)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',  // Tên sản phẩm là bắt buộc và có độ dài tối đa
            'price' => 'required|numeric|min:0',  // Giá sản phẩm là bắt buộc và phải là số dương
            'quantity' => 'required|integer|min:1',  // Số lượng sản phẩm là bắt buộc và phải là số nguyên dương
        ]);

        // Tạo sản phẩm mới
        Product::create($request->validated());

        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Product created successfully.');
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit($id)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu, nếu không tìm thấy sẽ trả về lỗi 404
        $product = Product::findOrFail($id);

        // Trả về view với dữ liệu sản phẩm để chỉnh sửa
        return view('products.edit', compact('product'));
    }

    // Xử lý cập nhật thông tin sản phẩm
    public function update(Request $request, $id)
    {
        // Xác thực dữ liệu đầu vào
        $request->validate([
            'name' => 'required|string|max:255',  // Tên sản phẩm là bắt buộc và có độ dài tối đa
            'price' => 'required|numeric|min:0',  // Giá sản phẩm là bắt buộc và phải là số dương
            'quantity' => 'required|integer|min:1',  // Số lượng sản phẩm là bắt buộc và phải là số nguyên dương
        ]);

        // Lấy sản phẩm từ cơ sở dữ liệu, nếu không tìm thấy sẽ trả về lỗi 404
        $product = Product::findOrFail($id);

        // Cập nhật sản phẩm với dữ liệu đã xác thực
        $product->update($request->validated());

        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Product updated successfully.');
    }

    // Xử lý xóa sản phẩm
    public function destroy($id)
    {
        // Lấy sản phẩm từ cơ sở dữ liệu, nếu không tìm thấy sẽ trả về lỗi 404
        $product = Product::findOrFail($id);

        // Xóa sản phẩm
        $product->delete();

        // Chuyển hướng về danh sách sản phẩm với thông báo thành công
        return redirect()->route('products.index')->with('success', 'Product deleted successfully.');
    }
}
