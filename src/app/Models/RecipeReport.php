<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecipeReport extends Model
{
    public $timestamps = false;
    protected $table = "tb_recipe_report";

    public function recipe() {
        return $this->belongsTo(Recipe::class, 'id_recipe');
    }
}
