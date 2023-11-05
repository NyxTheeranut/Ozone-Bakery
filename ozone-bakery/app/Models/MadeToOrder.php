<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MadeToOrder extends Model
{
    use HasFactory;

    public static $discount = 0.2;

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function made_to_order_details(){
        return $this->hasMany(MadeToOrderDetail::class);
    }

    public static function getDiscount(){
        return 1 - self::$discount;
    }
}
