<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'content',
    ]

    public function question()
    {
        $this->belongsTo('App\Models\Question');
    }

    public function user()
    {
        $this->belongsTo('App\Models\User');
    }
}