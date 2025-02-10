<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::paginate(10);
        return view('product.index', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('product.create', compact('suppliers', 'categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'brand' => 'required',

        ]);

        $image = null;

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/products/'), $imageName);
            $image = 'uploads/products/' . $imageName;
        }

        // Thêm mới
        Product::create([
            'name' => $request->name,
            'image' => $image,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
        ]);

        // Chuyển hướng
        return redirect()->route('products.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $product = Product::findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        return view('product.edit', compact('product', 'suppliers', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $product = Product::findOrFail($id);

        // Validate
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'category_id' => 'required',
            'supplier_id' => 'required',
            'brand' => 'required',

        ]);

        $image = $product->image; // Giữ ảnh cũ nếu không có ảnh mới

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/products/'), $imageName);
            $image = 'uploads/products/' . $imageName;
        }

        // Cập nhật thông tin
        $product->update([
            'name' => $request->name,
            'image' => $image,
            'category_id' => $request->category_id,
            'supplier_id' => $request->supplier_id,
            'brand' => $request->brand,
        ]);

        // Chuyển hướng
        return redirect()->route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        // Chuyển hướng
        return redirect()->route('products.index');
    }
}
