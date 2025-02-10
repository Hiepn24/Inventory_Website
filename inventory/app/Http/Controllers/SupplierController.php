<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Supplier;

// use Intervention\Image\ImageManager;
// use Intervention\Image\Drivers\Gd\Driver;


class SupplierController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $suppliers = Supplier::paginate(10);
        return view('supplier.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('supplier.create');
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
            'email' => 'required|unique:suppliers,email',
            'phone' => 'required|numeric|unique:suppliers,phone',
            'address' => 'required',

        ]);

        $image = null;

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/suppliers/'), $imageName);
            $image = 'uploads/suppliers/' . $imageName;
        }

        // Thêm mới
        Supplier::create([
            'name' => $request->name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Chuyển hướng
        return redirect()->route('suppliers.index');
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
        $supplier = Supplier::findOrFail($id);
        return view('supplier.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $supplier = Supplier::findOrFail($id);

        // Validate
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|unique:suppliers,email,' . $supplier->id, // Cập nhật điều kiện cho email
            'phone' => 'required|numeric|unique:suppliers,phone,' . $supplier->id, // Cập nhật điều kiện cho phone
            'address' => 'required',
        ]);

        $image = $supplier->image; // Giữ ảnh cũ nếu không có ảnh mới

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/suppliers/'), $imageName);
            $image = 'uploads/suppliers/' . $imageName;
        }

        // Cập nhật thông tin
        $supplier->update([
            'name' => $request->name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Chuyển hướng
        return redirect()->route('suppliers.index');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();
        // Chuyển hướng
        return redirect()->route('suppliers.index');
    }
}
