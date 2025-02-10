<?php

namespace App\Models;

use App\Models\Category;
use App\Models\Supplier;
use App\Models\PurchaseMeta;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name','image','category_id','supplier_id','brand'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class, 'supplier_id');
    }

    public function purchase_meta()
    {
        return $this->hasMany(PurchaseMeta::class, 'product_id');
    }
}
