<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;

class CustomerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $customers = Customer::paginate(10);
        return view('customer.index', compact('customers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('customer.create');
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
            'email' => 'required|unique:customers,email',
            'phone' => 'required|numeric|unique:customers,phone',
            'address' => 'required',

        ]);

        $image = null;

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/customers/'), $imageName);
            $image = 'uploads/customers/' . $imageName;
        }

        // Thêm mới
        Customer::create([
            'name' => $request->name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Chuyển hướng
        return redirect()->route('customers.index');
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
        $customer = Customer::findOrFail($id);
        return view('customer.edit', compact('customer'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $customer = customer::findOrFail($id);

        // Validate
        $request->validate([
            'name' => 'required|string',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
            'email' => 'required|unique:customers,email,' . $customer->id, // Cập nhật điều kiện cho email
            'phone' => 'required|numeric|unique:customers,phone,' . $customer->id, // Cập nhật điều kiện cho phone
            'address' => 'required',
        ]);

        $image = $customer->image; // Giữ ảnh cũ nếu không có ảnh mới

        // Xử lý ảnh
        if ($request->hasFile('image')) {
            $imageFile = $request->file('image');
            $imageName = time() . '.' . $imageFile->getClientOriginalExtension();
            $imageFile->move(public_path('/uploads/customers/'), $imageName);
            $image = 'uploads/customers/' . $imageName;
        }

        // Cập nhật thông tin
        $customer->update([
            'name' => $request->name,
            'image' => $image,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address,
        ]);

        // Chuyển hướng
        return redirect()->route('customers.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $customer = Customer::findOrFail($id);
        $customer->delete();
        // Chuyển hướng
        return redirect()->route('customers.index');
    }
}
