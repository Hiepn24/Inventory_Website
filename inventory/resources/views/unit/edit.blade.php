@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h2 class="text-2xl font-semibold mb-6">Cập nhật đơn vị</h2>
        <form action="{{ route('units.update', $unit->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="name">Tên</label>
                <input name="name" value="{{ $unit->name }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="name" type="text" placeholder="Name">
                @error('name')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4">
                <label class="block text-gray-700 text-sm font-bold mb-2" for="short_form">Viết tắt</label>
                <input name="short_form" value="{{ $unit->short_form }}" class="shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline" id="short_form" type="text" placeholder="Short form">
                @error('short_form')
                    <p class="text-red-500 text-md">{{ $message }}</p>
                @enderror
            </div>
            <div class="mb-4 justify-end flex">
                <button class="px-4 py-2 bg-blue-400 rounded-md text-white">Cập nhật</button>
            </div>
        </form>
    </div>
@endsection