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

    public function product(){
        return $this->belongsTo(Product::class);
    }
}
