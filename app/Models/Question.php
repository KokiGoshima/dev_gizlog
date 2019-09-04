<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function getQuestionsByCategory($category_num)
    {
        return $this
            ->where('tag_category_id', $category_num)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getQuestionsByTitleWord($searched_word)
    {
        return $this
            ->where('title', 'LIKE', "%$searched_word%")
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function getAllQuestions()
    {
        return $this
            ->orderBy('created_at', 'desc')
            ->get();
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    public function tag_category()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }
}

