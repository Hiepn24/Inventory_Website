@extends('layouts.app')

@section('content')
    <div class="w-full p-8 mt-5 bg-white rounded-lg shadow-md">
        <h1 class="text-xl font-semibold mb-6">Tạo mua hàng</h1>
        <form action="{{ route('purchases.store') }}" method="POST">
            @csrf
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                <div>
                    <label for="purchaseNo" class="block text-sm font-medium text-gray-700">Mã mua hàng</label>
                    <input type="text" name="purchase_no" id="purchaseNo" placeholder="Purchase No" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('purchase_no')
                        <p class="text-red-500 text-md">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="supplier" class="block text-sm font-medium text-gray-700">Nhà cung cấp</label>
                    <select name="supplier_id" id="supplier" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        <option selected disabled>Chọn nhà cung cấp</option>
                        @foreach ($suppliers as $supplier)
                            <option value="{{ $supplier->id }}">{{ $supplier->name }}</option>
                        @endforeach
                    </select>
                    @error('supplier_id')
                        <p class="text-red-500 text-md">{{ $message }}</p>
                    @enderror
                </div>
                <div>
                    <label for="paidAmount" class="block text-sm font-medium text-gray-700">Số tiền đã thanh toán</label>
                    <input type="text" name="paid_amount" id="paidAmount" placeholder="Paid Amount" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                    @error('paid_amount')
                        <p class="text-red-500 text-md">{{ $message }}</p>
                    @enderror
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
                            <th class="py-2 px-4 border-b text-left text-sm font-medium text-gray-700">
                                <button onclick="cloneRow()" type="button" class="text-green-500 hover:text-green-700">
                                    <i class="fas fa-plus"></i>
                                </button>
                            </th>
                        </tr>
                    </thead>
                    <tbody class="tbody">
                        <tr class="tr">
                            <td class="py-2 border-b">
                                <select name="category_id[]" class="category-select block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option selected disabled value="">Chọn danh mục</option>
                                    @foreach ($categories as $category)
                                        <option value="{{ $category->id }}">{{ $category->name }}</option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <p class="text-red-500 text-md">{{ $message }}</p>
                                @enderror
                            </td>
                            <td class="py-2 px-4 border-b">
                                <select name="product_id[]" class="product-select block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option selected disabled>Chọn sản phẩm</option>
                                    <!-- Products sẽ được thêm động bằng Ajax -->
                                </select>
                                @error('product_id')
                                    <p class="text-red-500 text-md">{{ $message }}</p>
                                @enderror
                            </td>
                            <td class="py-2 px-4 border-b">
                                <select name="unit_id[]" class="block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                    <option selected disabled>Chọn đơn vị</option>
                                    @foreach ($units as $unit)
                                        <option value="{{ $unit->id }}">{{ $unit->name }}</option>
                                    @endforeach
                                </select>
                                @error('unit_id')
                                    <p class="text-red-500 text-md">{{ $message }}</p>
                                @enderror
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" name="quantity[]" required placeholder="Quantity" onkeyup="calculateTotal(event)" class="block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" name="unit_price[]" required placeholder="Unit Price" onkeyup="calculateTotal(event)" class="block w-full border border-gray-300 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                            </td>
                            <td class="py-2 px-4 border-b">
                                <input type="text" name="total_price[]" disabled placeholder="Total" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                @error('total_price')
                                    <p class="text-red-500 text-md">{{ $message }}</p>
                                @enderror
                            </td>
                            <td class="py-2 px-4 border-b text-center">
                                <button type="button" onclick="removeRow(event)" class="text-red-500 hover:text-red-700">
                                    <i class="fas fa-times"></i>
                                </button>
                            </td>
                        </tr>
                    </tbody>
                    <tfoot>
                        <th colspan="5" class="text-left">Tổng mua hàng</th>
                        <td class="py-2 px-4">
                            <input type="text" name="total_amount" placeholder="Tổng" class="cursor-not-allowed block w-full border bg-gray-100 rounded-md shadow-sm p-2 focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                        </td>
                    </tfoot>
                </table>
            </div>
            <div class="mt-6">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded shadow hover:bg-blue-700">Thêm</button>
            </div>
        </form>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
            });

            $(document).on('change', '.category-select', function() {
                const categoryId = $(this).val();
                console.log('Selected Category ID:', categoryId);

                const row = $(this).closest('tr'); // Sửa từ '.tr' thành 'tr'
                const productSelect = row.find('.product-select');

                if (!categoryId) {
                    productSelect.html('<option selected disabled>Choose Product</option>');
                    return;
                }

                $.ajax({
                    url: '/get-products',
                    method: 'GET',
                    data: { category_id: categoryId },
                    success: function(response) {
                        let options = '<option selected disabled>Choose Product</option>';
                        response.products.forEach(product => {
                            options += `<option value="${product.id}">${product.name}</option>`;
                        });
                        productSelect.html(options);
                    },
                    error: function(xhr) {
                        console.error('Error fetching products:', xhr);
                    }
                });
            });
        });

        function cloneRow() {
            // Clone row đầu tiên và reset giá trị
            const originalRow = $('.tr:first').clone();
            originalRow.find('input[type="text"]').val('');
            originalRow.find('select').prop('selectedIndex', 0);
            originalRow.find('.product-select').html('<option selected disabled>Choose Product</option>');
            originalRow.find('input[disabled]').val('');
            $('.tbody').append(originalRow);
        }

        function removeRow(event) {
            $(event.target).closest('.tr').remove();
            calculateTotal(event);
        }

        function calculateTotal(event) {
            // Lấy row cha chứa ô đang nhập
            const row = $(event.target).closest('.tr');
            
            // Lấy giá trị quantity và unit price
            const quantity = parseFloat(row.find('input:eq(0)').val()) || 0;
            const unitPrice = parseFloat(row.find('input:eq(1)').val()) || 0;
            
            // Tính toán total
            const total = quantity * unitPrice;
            
            // Điền vào ô total
            row.find('input:eq(2)').val(total.toFixed(2));
            
            // Tính tổng tất cả các dòng
            let allTotal = 0;
            $('.tr').each(function() {
                const rowTotal = parseFloat($(this).find('input:eq(2)').val()) || 0;
                allTotal += rowTotal;
            });
            
            // Cập nhật tổng chung
            $('tfoot input').val(allTotal.toFixed(2));
        }
    </script>
@endsection
