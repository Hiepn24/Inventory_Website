<?php

namespace App\Models;

use App\Models\Unit;
use App\Models\Product;
use App\Models\Category;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;

class PurchaseMeta extends Model
{
    protected $fillable = [
        'purchase_id', 'category_id', 'product_id', 'unit_price', 'quantity', 'unit_id'
    ];

    public function purchase()
    {
        return $this->belongsTo(Purchase::class, 'purchase_id');
    }

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'unit_id');
    }
}
