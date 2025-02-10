<?php

namespace App\Http\Controllers;

use App\Models\Unit;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;

class UnitController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $units = Unit::paginate(10);
        return view('unit.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('unit.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validate
        $request->validate([
            'name' => 'required|string',
            'short_form' => 'required|string'
        ]);

        // Thêm mới
        Unit::create([
            'name' => $request->name,
            'short_form' => $request->short_form
        ]);

        // Chuyển hướng
        return redirect()->route('units.index');
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
        $unit = Unit::findOrFail($id);
        return view('unit.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $unit = Unit::findOrFail($id);

        // Validate
        $request->validate([
            'name' => 'required|string',
            'short_form' => 'required|string'
        ]);

        // Cập nhật thông tin
        $unit->update([
            'name' => $request->name,
            'short_form' => $request->short_form,
        ]);

        // Chuyển hướng
        return redirect()->route('units.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $unit = Unit::findOrFail($id);
        $unit->delete();
        // Chuyển hướng
        return redirect()->route('units.index');
    }
}
