<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;

// Giúp Laravel tự động tạo các route xác thực (đăng nhập, đăng ký, đăng xuất,...)
Auth::routes();


// Middleware auth trong Laravel đảm bảo rằng chỉ người dùng đã đăng nhập (authenticated) mới có thể 
// truy cập các route này. Nếu người dùng chưa đăng nhập, họ sẽ bị chuyển hướng đến trang đăng nhập.
Route::middleware(['auth'])->group(function() {
               // url                      // tên phương thức trong controller      // tên của route
    Route::get('/home', [HomeController::class, 'index'])->name('home');
    // Ứng dụng tên của route:
    // 1. Chuyển hướng đến trang /home: return redirect()->route('home');
    // 2. Tạo link trong Blade template: <a href="{{ route('home') }}">Trang chủ</a>
    // 3. Xử lý trong controller: return view('home'); hoặc redirect()->route('home');

    Route::resource('/suppliers', SupplierController::class, ['name' => 'supplier']);
    Route::resource('/customers', CustomerController::class, ['name' => 'customer']);
    Route::resource('/categories', CategoryController::class, ['name' => 'category']);
    Route::resource('/products', ProductController::class, ['name' => 'product']);
    Route::resource('/units', UnitController::class, ['name' => 'unit']);
    Route::resource('/purchases', PurchaseController::class, ['name' => 'purchase']);
    Route::get('/get-products', [PurchaseController::class, 'getProducts']);
});