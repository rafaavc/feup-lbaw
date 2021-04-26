<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    public $timestamps = false;
    protected $table = "tb_comment";

    public function owner() {
        return $this->belongsTo('App\Models\Member', 'id_member', 'id');
    }

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe', 'id_recipe', 'id');
    }
}
