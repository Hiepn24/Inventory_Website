<?php

namespace App\Models;

use App\Models\PurchaseMeta;
use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    protected $fillable = [
        'name','short_form'
    ];

    public function purchase_meta()
    {
        return $this->hasMany(PurchaseMeta::class, 'unit_id');
    }
}
