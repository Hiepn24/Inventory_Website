@extends('layouts.app')

@section('content')
    <div class="container mx-auto bg-white p-5 rounded-md shadow-sm">
        <h2 class="text-xl font-semibold mb-4">
           Thông tin mua hàng
        </h2>
        <hr class="mb-4">
        <a href="{{ route('purchases.create') }}" class="px-4 py-2 bg-green-400 rounded-md text-white">
            <i class="fa-sharp fa-solid fa-plus"></i>
        </a>
        <a href="#" id="exportPdf" class="px-4 py-2 ml-2 bg-red-500 rounded-md text-white">
            <i class="fa-sharp fa-solid fa-print"></i> Xuất file PDF
        </a>
        <div class="bg-white shadow-md rounded-lg overflow-hidden mt-5">
           <table class="min-w-full bg-white">
              <thead class="bg-gray-100 text-gray-600">
                 <tr>
                    <th class="py-3 px-4 text-left">
                        STT
                    </th>
                    <th class="py-3 px-4 text-left">
                        Mã mua hàng
                    </th>
                    <th class="py-3 px-4 text-left">
                        Tổng số tiền
                    </th>
                    <th class="py-3 px-4 text-left">
                        Số tiền đã thanh toán
                    </th>
                    <th class="py-3 px-4 text-left">
                        Số tiền đến hạn
                    </th>
                    <th class="py-3 px-4 text-left">
                        Ngày tạo
                    </th>
                    <th class="py-3 px-4 text-left">
                        Ngày cập nhật
                    </th>
                    <th class="py-3 px-4 text-left" colspan="3">
                        Hành động
                    </th>
                 </tr>
              </thead>
              <tbody class="text-gray-700">
                @foreach ($purchases as $purchase)
                    <tr>
                        <td class="py-3 px-4">
                            {{ $loop->index + 1 }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->purchase_no }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->total_amount }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->paid_amount }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->due_amount }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->created_at }}
                        </td>
                        <td class="py-3 px-4">
                            {{ $purchase->updated_at }}
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('purchases.show', $purchase->id) }}" class="bg-green-500 text-white px-4 py-2 rounded">
                                <i class="fa-sharp fa-solid fa-eye"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <a href="{{ route('purchases.edit', $purchase->id) }}" class="bg-blue-500 text-white px-4 py-2 rounded">
                                <i class="fa-duotone fa-regular fa-pen-to-square"></i>
                            </a>
                        </td>
                        <td class="py-3 px-4">
                            <form action="{{ route('purchases.destroy', $purchase->id)}}" method="post">
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
        {{ $purchases->links() }}
    </div>
@endsection

@section('scripts')
    <script>
        document.getElementById("exportPdf").addEventListener("click", function () {
        const { jsPDF } = window.jspdf;
        const pdf = new jsPDF();

        // Chụp bảng dữ liệu
        html2canvas(document.querySelector("table")).then((canvas) => {
            const imgData = canvas.toDataURL("image/png");
            const imgWidth = 190;
            const imgHeight = (canvas.height * imgWidth) / canvas.width;

            pdf.addImage(imgData, "PNG", 10, 10, imgWidth, imgHeight);
            pdf.save("purchases_report.pdf");
        });
    });
    </script>
@endsection