<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    protected $fillable = [
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    public function comments()
    {
        $this->hasMany('App\Models\Comment');
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }
}

