<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class TagCategory extends Model
{
    use SoftDeletes;

    protected $fillable = ['name'];
    protected $table = 'tag_categories';
    protected $dates = ['deleted_at'];

    public function setTagCategories()
    {
        $tag_categories = $this::all();
        $res = [];
        foreach ($tag_categories as $tag_category){
            $res[] = $tag_category->name;
        }

        return $res;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

}

