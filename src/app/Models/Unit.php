<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Unit extends Model
{
    public $timestamps = false;
    protected $table = "tb_unit";

    public function units() {
        return $this->belongsToMany(Unit::class, 'tb_conversion', 'unit_1', 'unit_2')->withPivot("factor");
    }

    // Don't really think it's useful for a Unit to check its "ingredient_recipes"
}
