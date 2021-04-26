<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
    public $timestamps = false;
    protected $table = "tb_ingredient";

    public function recipes() {
        return $this->belongsToMany(Recipe::class, 'tb_ingredient_recipe', 'id_ingredient', 'id_recipe')
            ->withPivot("id_unit", "quantity");
    }
}
