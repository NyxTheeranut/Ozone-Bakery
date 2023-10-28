<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    public function recipe_details(){
        return $this->hasMany(RecipeDetail::class);
    }

    public function made_to_orders(){
        return $this->hasMany(MadeToOrder::class);
    }

    public function products(){
        return $this->belongsTo(Product::class);
    }
}
