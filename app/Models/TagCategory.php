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
        $count = 1;
        $length = count($tag_categories);
        $res = '';
        foreach ($tag_categories as $tag_category){
            if ($count < $length){
                $res = $res. $tag_category->name. ',';
            }else {
                $res = $res. $tag_category->name;
            }

        $count++;
        }

        return $res;
    }

    public function questions()
    {
        return $this->hasMany('App\Models\Question');
    }

}

