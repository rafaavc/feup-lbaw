<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    public $timestamps = false;
    protected $table = "tb_message";

    protected $fillable = ['text'];

    public function sender()
    {
        return $this->belongsTo('App\Models\Member', 'id_sender', 'id');
    }

    public function receiver()
    {
        return $this->belongsTo('App\Models\Member', 'id_receiver', 'id');
    }
}
