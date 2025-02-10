<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use App\Models\Supplier;
use App\Models\PurchaseMeta;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $purchases = Purchase::paginate(10);
        return view('purchase.index', compact('purchases'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $suppliers = Supplier::all();
        $categories = Category::all();
        $products = Product::all();
        $units = Unit::all();
        return view('purchase.create', compact('suppliers', 'categories', 'products', 'units'));
    }

    public function getProducts(Request $request)
    {
        $request->validate([
            'category_id' => 'required|exists:categories,id'
        ]);

        $products = Product::where('category_id', $request->category_id)->get();
        
        return response()->json([
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate 
        $request->validate([
            'purchase_no' => 'required|unique:purchases',
            'supplier_id' => 'required|integer',
            'paid_amount' => 'required',
            'category_id' => 'required|array',
            'product_id' => 'required|array',
            'unit_id' => 'required|array',
            'quantity' => 'required|array',
            'unit_price' => 'required|array',
        ]);

        // Tạo purchase
        $purchase = Purchase::create([
            'purchase_no' => $request->purchase_no,
            'supplier_id' => $request->supplier_id,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->total_amount - $request->paid_amount 
        ]);

        // Thêm purchase metas
        foreach ($request->category_id as $index => $categoryId) {
            PurchaseMeta::create([
                'purchase_id' => $purchase->id,
                'category_id' => $categoryId,
                'product_id' => $request->product_id[$index],
                'unit_id' => $request->unit_id[$index],
                'quantity' => $request->quantity[$index],
                'unit_price' => $request->unit_price[$index],
            ]);
        }

        return redirect()->route('purchases.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $purchase = Purchase::with('purchases_meta.category', 'purchases_meta.product', 'purchases_meta.unit')
                        ->findOrFail($id);
        return view('purchase.show', compact('purchase'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $purchase = Purchase::with('purchases_meta.category', 'purchases_meta.product', 'purchases_meta.unit')
                        ->findOrFail($id);
        $suppliers = Supplier::all();
        $categories = Category::all();
        $products = Product::all();
        $units = Unit::all();
        return view('purchase.edit', compact('purchase','suppliers', 'categories', 'products', 'units'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Tìm purchase theo ID, nếu không có thì trả về lỗi 404
        $purchase = Purchase::findOrFail($id);

        // Validate dữ liệu đầu vào
        $request->validate([
            'purchase_no' => 'required|unique:purchases,purchase_no,' . $id,
            'supplier_id' => 'required|integer',
            'paid_amount' => 'required|numeric',
            'category_id' => 'required|array',
            'product_id' => 'required|array',
            'unit_id' => 'required|array',
            'quantity' => 'required|array',
            'unit_price' => 'required|array',
        ]);

        // Cập nhật thông tin purchase
        $purchase->update([
            'purchase_no' => $request->purchase_no,
            'supplier_id' => $request->supplier_id,
            'total_amount' => $request->total_amount,
            'paid_amount' => $request->paid_amount,
            'due_amount' => $request->total_amount - $request->paid_amount
        ]);

        // Xóa tất cả PurchaseMeta cũ của purchase này
        PurchaseMeta::where('purchase_id', $id)->delete();

        // Thêm lại các purchase metas mới
        foreach ($request->category_id as $index => $categoryId) {
            PurchaseMeta::create([
                'purchase_id' => $purchase->id,
                'category_id' => $categoryId,
                'product_id' => $request->product_id[$index],
                'unit_id' => $request->unit_id[$index],
                'quantity' => $request->quantity[$index],
                'unit_price' => $request->unit_price[$index],
            ]);
        }

        return redirect()->route('purchases.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $purchase = Purchase::findOrFail($id);
        $purchase->delete();
        return redirect()->route('purchases.index');
    }
}
