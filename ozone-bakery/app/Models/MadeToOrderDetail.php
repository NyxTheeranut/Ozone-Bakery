<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadeToOrderDetail extends Model
{
    use HasFactory;

    public function price()
    {
        return $this->amount * $this->product->price * MadeToOrder::getDiscount();
    }

    public function madeToOrder()
    {
        return $this->belongsTo(MadeToOrder::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
