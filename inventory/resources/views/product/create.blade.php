@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Thêm sản phẩm</h2>
        <form action="{{ route('products.store') }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Tên sản phẩm</label>
                <input name="name" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
                @error('name')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="product-image">Ảnh sản phẩm</label>
                <input name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplier-image" type="file">
                @error('image')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="brand">Thương hiệu</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    <input name="brand" class="w-full text-gray-700 leading-tight focus:outline-none" id="brand" type="text" placeholder="Brand">
                </div>
                @error('brand')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone-number">Danh mục</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <select name="category_id" class="border-2 border-gray-300">
                        <option selected disabled>Chọn danh mục</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('category_id')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone-number">Nhà cung cấp</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <select name="supplier_id" class="border-2 border-gray-300">
                        <option selected disabled>Chọn nhà cung cấp</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                </div>
                @error('supplier_id')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 justify-end flex">
                <button class="px-4 py-2 bg-blue-400 rounded-md text-white">Thêm</button>
            </div>
        </form>
    </div>
@endsection