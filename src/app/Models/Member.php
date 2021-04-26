<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Member extends Authenticatable
{
    use Notifiable;

    // Don't add create and update timestamps in database.
    public $timestamps = false;
    protected $table = "tb_member";

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'city', 'bio', 'visibility', 'is_banned', 'id_country', 'score'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'email'
    ];

    public function recipes() {
        return $this->hasMany('App\Models\Recipe', 'id_member', 'id');
    }
}
