<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RecipeDetail extends Model
{
    use HasFactory;

    public function recipe(){
        return $this->belongsTo(Recipe::class);
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
