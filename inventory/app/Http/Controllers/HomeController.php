<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Product;
use App\Models\Purchase;
use App\Models\Supplier;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    //     // $this->middleware('auth')->except(['index']);
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $productCount = Product::all()->count();
        $purchaseCount = Purchase::wheredate('created_at', Carbon::today())->count();
        $purchaseSum = Purchase::wheredate('created_at', Carbon::today())->sum('total_amount');

        $suppliers = Supplier::orderByDesc('created_at')->take(5)->get();
        $purchases = Purchase::orderByDesc('created_at')->take(5)->get();
        return view('home', compact('productCount', 'purchaseCount', 'purchaseSum', 'suppliers', 'purchases'));
    }

    public function test1() 
    {
        return view('test');
    }
}
