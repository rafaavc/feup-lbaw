<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    public $timestamps = false;
    protected $table = "tb_recipe";

    protected $fillable = [
        'name', 'difficulty', 'description', 'servings', 'preparation_time',
        'cooking_time', 'additional_time', 'creation_time'
    ];

    protected $cast = [
        'creation_time' => 'datetime'
    ];

    public function ingredients() {
        return $this->belongsToMany(Ingredient::class, 'tb_ingredient_recipe', 'id_recipe', 'id_ingredient')
            ->withPivot("id_unit", "quantity");
    }

    public function tags() {
        return $this->belongsToMany(Tag::class, 'tb_tag_recipe', 'id_recipe', 'id_tag');
    }

    public function membersWhoFavourited() {
        return $this->belongsToMany(Member::class, 'tb_favourite', 'id_recipe', 'id_member');
    }

    public function comments() {
        return $this->hasMany(Comment::class, 'id_recipe');
    }

    public function steps() {
        return $this->hasMany(Step::class, 'id_recipe');
    }

    public function reports() {
        return $this->hasMany(Recipe_Report::class, 'id_recipe');
    }

    public function author() {
        return $this->belongsTo(Member::class, 'id_member');
    }

    public function category() {
        return $this->belongsTo(Category::class, 'id_category');
    }

    public function group() {
        return $this->belongsTo(Group::class, 'id_group');
    }

    // favouritedNotifications() not useful
}
