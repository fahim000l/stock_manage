<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\products_collection;
use App\Models\quantity_stock;

class product_stock extends Model
{
    use HasFactory;

    public function products_info(){
        return $this->hasOne(products_collection::class,'product_code','product_code');
    }

    public function product_quantity(){
        return $this->hasMany(quantity_stock::class,'product_code','product_code');
    }
}
