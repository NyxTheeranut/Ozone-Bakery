<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function order_details(){
        return $this->hasMany(OrderDetail::class);
    }

    public function order_stock_details(){
        return $this->hasMany(OrderStockDetail::class);
    }

    public function totalPrice(){
        $totalPrice = 0;
        foreach ($this->order_details as $order_detail) {
            $totalPrice += $order_detail->product->price * $order_detail->amount;
        }
        return $totalPrice;
    }
}
