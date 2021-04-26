<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public $timestamps = false;
    protected $table = "tb_tag";

    public function recipes() {
        return $this->belongsToMany('App\Models\Recipe', 'tb_tag_recipe', 'id_tag', 'id_recipe');
    }
}
