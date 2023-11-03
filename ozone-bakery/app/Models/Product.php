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

    public function recipe(){
        return $this->hasOne(Recipe::class);
    }

    public function made_to_order_details(){
        return $this->hasMany(MadeToOrderDetail::class);
    }

    public function made_to_order_carts(){
        return $this->hasMany(MadeToOrderCart::class);
    }

}
