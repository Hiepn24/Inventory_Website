@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Cập nhật danh mục</h2>
        <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Tên danh mục</label>
                <input name="name" value="{{ $category->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
                @error('name')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 justify-end flex">
                <button class="px-4 py-2 bg-blue-400 rounded-md text-white">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection