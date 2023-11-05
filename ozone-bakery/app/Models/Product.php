<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    public function getStock($pickupDate)
    {
        $totalStock = ProductStock::where('product_id', $this->id)
            ->where('amount', '>', 0)
            ->where('exp_date', '>=', $pickupDate)
            ->sum('amount');
        return $totalStock;
    }

    public function withdrawStock($pickupDate, $amount){
        $productStocks = ProductStock::where('product_id', $this->id)
            ->where('exp_date', '>=', $pickupDate)
            ->orderBy('exp_date')
            ->get();

        $withdrawnAmount = 0;
        foreach($productStocks as $stock){
            if($withdrawnAmount < $amount){
                if($stock->amount > $amount - $withdrawnAmount){
                    $stock->amount -= $amount - $withdrawnAmount;
                    $stock->save();
                    $withdrawnAmount = $amount;
                }else{
                    $withdrawnAmount += $stock->amount;
                    $stock->amount = 0;
                    $stock->save();
                }
            }
        }
    }

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

}
