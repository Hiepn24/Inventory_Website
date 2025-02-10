<?php

namespace App\Models;

use App\Models\Product;
use App\Models\Purchase;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    protected $fillable = [
        'name','image','email','phone','address'
    ];

    public function products()
    {
        return $this->hasMany(Product::class, 'supplier_id');
    }

    public function purchases()
    {
        return $this->hasMany(Purchase::class, 'supplier_id');
    }
}
