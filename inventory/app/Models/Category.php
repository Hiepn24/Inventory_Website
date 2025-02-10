<?php

namespace App\Models;

use App\Models\Product;
use App\Models\PurchaseMeta;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = [
        'name'
    ];

    public function product()
    {
        return $this->hasMany(Product::class, 'category_id');
    }

    public function purchase_meta()
    {
        return $this->hasMany(PurchaseMeta::class, 'category_id');
    }
}
