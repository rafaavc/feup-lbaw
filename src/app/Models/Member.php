<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Country;
use App\Models\Comment;

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
        'name', 'email', 'password', 'username', 'city', 'bio'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'email', 'search', 'num_rating', 'is_banned', 'visibility', 'bio', 'id_country'
    ];

    protected $appends = ['biography', 'number_of_recipes', 'number_of_followers', 'number_of_following'];

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'username';
    }

    public function recipes()
    {
        return $this->hasMany('App\Models\Recipe', 'id_member', 'id');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'id_member', 'id');
    }

    public function country()
    {
        return $this->belongsTo(Country::class, 'id_country');
    }

    public function following()
    {
        return $this->belongsToMany(Member::class, 'tb_following', 'id_following', 'id_followed')
            ->withPivot("state", "timestamp");
    }

    public function followers()
    {
        return $this->belongsToMany(Member::class, 'tb_following', 'id_followed', 'id_following')
            ->withPivot("state", "timestamp");
    }

    public function getBiographyAttribute()
    {
        return $this->attributes['bio'];
    }

    public function getNumberOfRecipesAttribute()
    {
        return $this->recipes()->count();
    }

    public function getNumberOfFollowersAttribute()
    {
        return $this->followers()->count();
    }

    public function getNumberOfFollowingAttribute()
    {
        return $this->following()->count();
    }
}
