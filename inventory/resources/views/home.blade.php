@extends('layouts.app')

@section('content')
    <div class="container mx-auto p-5 rounded-md">
        <!-- Top Cards -->
        <div class="grid grid-cols-1 md:grid-cols-3 gap-4 mb-6">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full p-3">
                        <i class="fa-solid fa-shirt"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600">Tổng số sản phẩm có sẵn</p>
                        <p class="text-2xl font-bold">{{ $productCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full p-3">
                        <i class="fas fa-dollar-sign"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600">Mua hàng hôm nay</p>
                        <p class="text-2xl font-bold">{{ $purchaseCount }}</p>
                    </div>
                </div>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex items-center">
                    <div class="bg-blue-500 text-white rounded-full p-3">
                        <i class="fas fa-shopping-bag"></i>
                    </div>
                    <div class="ml-4">
                        <p class="text-gray-600">Bán hàng hôm nay</p>
                        <p class="text-2xl font-bold">{{ $purchaseSum }} VNĐ</p>
                    </div>
                </div>
            </div>
        </div>

        <!-- Unpaid Invoices and Purchases -->
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Nhà cung cấp mới</h2>
                    <a href="{{ route('suppliers.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-full">Xem tất cả</a>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="py-2 pl-2">STT</th>
                            <th class="py-2">Tên nhà cung cấp</th>
                            <th class="py-2">Số điện thoại</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <td class="pl-2 py-3 px-4">{{ $loop->index + 1 }}</td>
                                <td>{{ $supplier->name }}</td>
                                <td>{{ $supplier->phone }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="bg-white shadow-md rounded-lg p-6">
                <div class="flex justify-between items-center mb-4">
                    <h2 class="text-lg font-bold">Mua hàng mới</h2>
                    <a href="{{ route('purchases.index') }}" class="bg-red-500 text-white px-4 py-2 rounded-full">Xem tất cả</a>
                </div>
                <table class="w-full text-left">
                    <thead class="bg-gray-100 text-gray-600">
                        <tr>
                            <th class="py-2 pl-2">STT</th>
                            <th class="py-2">Mã mua hàng</th>
                            <th class="py-2">Tổng số tiền</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($purchases as $purchase)
                            <tr>
                                <td class="pl-2 py-3 px-4">{{ $loop->index + 1 }}</td>
                                <td>{{ $purchase->purchase_no }}</td>
                                <td>{{ $purchase->total_amount }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
