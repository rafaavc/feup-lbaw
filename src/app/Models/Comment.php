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

    public function replies() {
        return $this->belongsToMany('App\Models\Comment', 'tb_answer', 'father_comment', 'id_comment');
    }

    public function fatherComments() {
        return $this->belongsToMany('App\Models\Comment', 'tb_answer', 'id_comment', 'father_comment');
    }

    public function recipe() {
        return $this->belongsTo('App\Models\Recipe', 'id_recipe', 'id');
    }

    public function reports() {
        return $this->hasMany(CommentReport::class, 'id_comment');
    }
}
