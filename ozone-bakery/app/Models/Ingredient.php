<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    use HasFactory;

    public function recipe_details(){
        return $this->hasMany(RecipeDetail::class);
    }

    public function isDeletable(){
        $recipe_details = $this->recipe_details;
        if($recipe_details->count() > 0){
            return false;
        }
        return true;
    }
}
