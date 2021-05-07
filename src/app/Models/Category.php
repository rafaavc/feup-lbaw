<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public $timestamps = false;
    protected $table = "tb_category";

    public function recipes() {
        return $this->hasMany('App\Models\Recipe', 'id_category', 'id');
    }

    public function getNumRecipes() {
        return $this->recipes()->count();
    }
}
