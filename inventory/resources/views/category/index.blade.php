@extends('layouts.app')

@section('content')
    <div class="container mx-auto bg-white p-5 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold mb-4">
           Thông tin danh mục
        </h2>
        <hr class="mb-4">
        <a href="{{ route('categories.create') }}" class="px-4 py-2 bg-green-400 rounded-md text-white">
            <i class="fa-sharp fa-solid fa-plus"></i>
        </a>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mt-5">
           <table class="min-w-full bg-white">
              <thead class="bg-gray-100 text-gray-600">
                 <tr>
                    <th class="py-3 px-4 text-left">
                       STT
                    </th>
                    <th class="py-3 px-4 text-left">
                       Tên
                    </th>
                    <th class="py-3 px-4 text-left">
                       Ngày tạo
                    </th>
                    <th class="py-3 px-4 text-left">
                       Ngày cập nhật
                    </th>
                    <th class="py-3 px-4 text-left" colspan="2">
                       Hành động
                    </th>
                 </tr>
              </thead>
              <tbody class="text-gray-700">
                @foreach ($categories as $category)
                    <tr>
                        <td class="py-3 px-4">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $category->name }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $category->created_at }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $category->updated_at }}
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('categories.edit', $category->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                                <i class="fa-duotone fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <form action="{{ route('categories.destroy', $category->id)}}" method="post">
                                @csrf
                                @method('DELETE')
                                <button class="bg-red-500 text-white px-4 py-2 mt-2 rounded">
                                    <i class="fa-sharp fa-solid fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>  
                @endforeach
              </tbody>
           </table>
        </div>
    </div>
    <!-- Hiển thị phân trang -->
    <div class="py-4">
        {{ $categories->links() }}
    </div>
@endsection