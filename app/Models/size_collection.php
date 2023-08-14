<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\quantity_stock;

class size_collection extends Model
{
    use HasFactory;
    public function size_quantity(){
        return $this->hasMany(quantity_stock::class,'size_id','size_id');
    }
}
