<?php

namespace App\Models;

use App\Models\Member;
use App\Models\Recipe;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    public $timestamps = false;
    protected $table = "tb_group";

    protected $fillable = [
        'name', 'description', 'visibility'
    ];

    public function moderators()
    {
        return $this->belongsToMany(Member::class, 'tb_group_moderator', 'id_group', 'id_member');
    }

    public function members()
    {
        return $this->belongsToMany(Member::class, 'tb_group_member', 'id_group', 'id_member');
    }

    public function requests()
    {
        return $this->belongsToMany(Member::class, 'tb_group_request', 'id_group', 'id_member')
            ->withPivot("state", "timestamp");
    }

    public function recipes()
    {
        return $this->hasMany(Recipe::class, 'id_group', 'id');
    }
}
