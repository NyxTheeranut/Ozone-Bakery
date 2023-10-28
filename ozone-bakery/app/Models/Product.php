<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function product_stocks(){
        return $this->hasMany(ProductStock::class);
    }

    public function carts(){
        return $this->hasMany(Cart::class);
    }
}
