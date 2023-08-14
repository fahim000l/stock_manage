<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\product_stock;
use App\Models\quantity_stock;

class invoices_collection extends Model
{
    use HasFactory;

    public function invoice_products(){
        return $this->hasMany(product_stock::class,'trans_id','trans_id');
    }

    public function invoice_quantity(){
        return $this->hasMany(quantity_stock::class,'trans_id','trans_id');
    }

}