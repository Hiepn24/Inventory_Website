@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Cập nhật nhà cung cấp</h2>
        <form action="{{ route('suppliers.update', $supplier->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Họ tên</label>
                <input name="name" value="{{ $supplier->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
                @error('name')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="supplier-image">Ảnh đại diện</label>
                <input name="image" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="supplier-image" type="file">
                <div>
                    <img src="{{ asset($supplier->image) }}" alt="" class="w-24 h-24 mt-2 ml-2 rounded-full" height="100">
                </div>
                @error('image')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="email">Email</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <i class="fas fa-envelope text-gray-500 mr-2"></i>
                    <input value="{{ $supplier->email }}" name="email" class="w-full text-gray-700 leading-tight focus:outline-none" id="email" type="email" placeholder="Email">
                </div>
                @error('email')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="phone-number">Số điện thoại</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <i class="fas fa-phone text-gray-500 mr-2"></i>
                    <input value="{{ $supplier->phone }}" name="phone" class="w-full text-gray-700 leading-tight focus:outline-none" id="phone-number" type="tel" placeholder="Phone Number">
                </div>
                @error('phone')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="address">Địa chỉ</label>
                <div class="flex items-center border rounded w-full py-2 px-3 shadow appearance-none focus:outline-none focus:shadow-outline">
                    <i class="fas fa-home text-gray-500 mr-2"></i>
                    <input value="{{ $supplier->address }}" name="address" class="w-full text-gray-700 leading-tight focus:outline-none" id="address" type="text" placeholder="Address">
                </div>
                @error('address')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 justify-end flex">
                <button class="px-4 py-2 bg-blue-400 rounded-md text-white">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection