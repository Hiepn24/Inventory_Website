@extends('layouts.app')

@section('content')
    <div class="container mx-auto bg-white p-5 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold mb-4">
           Thông tin nhà cung cấp
        </h2>
        <hr class="mb-4">
        <a href="{{ route('suppliers.create') }}" class="px-4 py-2 bg-green-400 rounded-md text-white">
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
                       Ảnh đại diện
                    </th>
                    <th class="py-3 px-4 text-left">
                       Tên
                    </th>
                    <th class="py-3 px-4 text-left">
                       Email
                    </th>
                    <th class="py-3 px-4 text-left">
                       Số điện thoại
                    </th>
                    <th class="py-3 px-4 text-left">
                       Địa chỉ
                    </th>
                    <th class="py-3 px-4 text-left" colspan="2">
                       Hành động
                    </th>
                 </tr>
              </thead>
              <tbody class="text-gray-700">
                @foreach ($suppliers as $supplier)
                    <tr>
                        <td class="py-3 px-4">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="py-3 px-4">
                            <img alt="avartar" class="w-16 h-16 rounded-full" height="100" src="{{ asset($supplier->image) }}" width="100"/>
                        </td>
                        <td class="py-3 px-4">
                            {{ $supplier->name }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $supplier->email}}
                        </td>
                        <td class="py-3 px-4">
                            {{ $supplier->phone}}
                        </td>
                        <td class="py-3 px-4">
                            {{ $supplier->address}}
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('suppliers.edit', $supplier->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                                <i class="fa-duotone fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4">
                                <form action="{{ route('suppliers.destroy', $supplier->id)}}" method="post">
                                    @csrf
                                    @method('DELETE')
                                    <button class="bg-red-500 text-white px-4 py-2 mt-3 rounded">
                                        <i class="fa-sharp fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            {{-- </div> --}}
                        </td>
                    </tr>  
                @endforeach
                 
              </tbody>
           </table>
        </div>
    </div>
    <!-- Hiển thị phân trang -->
    <div class="py-4">
        {{ $suppliers->links() }}
    </div>
@endsection