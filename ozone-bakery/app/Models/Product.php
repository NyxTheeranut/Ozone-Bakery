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

    /*
    SELECT products.id, products.name, SUM(product_stocks.amount) AS total_stock
    FROM products
    LEFT JOIN product_stocks ON products.id = product_stocks.product_id
    WHERE product_stocks.exp_date >= pickup_date
    GROUP BY products.id;

    INSERT INTO carts (user_id, product_id, amount)
    VALUES (id ลูกค้า, id สินค้า่, จำนวน);

    SELECT * FROM carts
    WHERE user_id = id ลูกค้า
    */

    public function withdrawStock($pickupDate, $amount)
    {
        $productStocks = ProductStock::where('product_id', $this->id)
            ->where('exp_date', '>=', $pickupDate)
            ->orderBy('exp_date')
            ->get();

        $withdrawnAmount = 0;
        foreach ($productStocks as $stock) {
            if ($withdrawnAmount < $amount) {
                if ($stock->amount > $amount - $withdrawnAmount) {
                    $stock->amount -= $amount - $withdrawnAmount;
                    $stock->save();
                    $withdrawnAmount = $amount;
                } else {
                    $withdrawnAmount += $stock->amount;
                    $stock->amount = 0;
                    $stock->save();
                }
            }
        }
    }

    public function order_details()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function product_stocks()
    {
        return $this->hasMany(ProductStock::class);
    }

    public function carts()
    {
        return $this->hasMany(Cart::class);
    }

    public function recipe()
    {
        return $this->hasOne(Recipe::class);
    }

    public function made_to_order_details()
    {
        return $this->hasMany(MadeToOrderDetail::class);
    }
}
