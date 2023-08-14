<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_stock;
use App\Models\quantity_stock;

class products_collection extends Model
{
    use HasFactory;

    public function stock_product_info(){
        return $this->hasMany(product_stock::class,'product_code','product_code');
    }

    public function stock_quantity_info(){
        return $this->hasMany(quantity_stock::class,'product_code','product_code');
    }
}