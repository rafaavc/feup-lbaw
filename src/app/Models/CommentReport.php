<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CommentReport extends Model
{
    public $timestamps = false;
    protected $table = "tb_comment_report";

    public function comment() {
        return $this->belongsTo(Comment::class, 'id_comment');
    }
}
