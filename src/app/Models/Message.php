<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public $timestamps = false;
    protected $table = "tb_message";

    protected $fillable = ['text', 'sender'];

    public function sender()
    {
        return $this->belongsTo('App\Models\Member', 'sender', 'id');
    }
}
