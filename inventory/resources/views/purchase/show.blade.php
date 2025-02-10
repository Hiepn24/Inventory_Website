@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h1 class="text-xl font-semibold mb-6">Xem chi tiết mua hàng</h1>
        <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
            <div>
                <label for="purchaseNo" class="block text-sm font-medium text-gray-700">Mã mua hàng</label>
                <input type="text" disabled value="{{ $purchase->purchase_no }}" name="purchase_no" id="purchaseNo" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="supplier" class="block text-sm font-medium text-gray-700">Nhà cung cấp</label>
                <input type="text" disabled value="{{ $purchase->supplier->name }}" name="purchase_no" id="purchaseNo" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
            <div>
                <label for="paidAmount" class="block text-sm font-medium text-gray-700">Số tiền đã thanh toán</label>
                <input type="text" value="{{ $purchase->paid_amount }}" disabled name="paid_amount" id="paidAmount" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
            </div>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="w-full bg-gray-200">
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Danh mục</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Sản phẩm</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Đơn vị</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Số lượng</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Đơn giá</th>
                        <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">Tổng</th>
                    </tr>
                </thead>
                <tbody class="tbody">
                    @foreach ($purchase->purchases_meta as $item)
                        <tr>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->category->name }}" class="cursor-not-allowed block w-full border bg-gray-100 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->product->name}}" class="cursor-not-allowed block w-full border bg-gray-100 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->unit->name }}" class="cursor-not-allowed block w-full border bg-gray-100 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->quantity }}" class="cursor-not-allowed block w-full border bg-gray-100 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->unit_price }}" class="cursor-not-allowed block w-full border bg-gray-100 border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" disabled value="{{ $item->quantity * $item->unit_price }}" name="total_price[]" disabled placeholder="Total" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                        </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <th colspan="5" class="text-left">Tổng mua hàng</th>
                    <td class="py-2 px-4">
                        <input type="text" value="{{ $purchase->total_amount }}" name="total_amount" placeholder="All Total" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    </td>
                </tfoot>
            </table>
        </div>
    </div>
@endsection