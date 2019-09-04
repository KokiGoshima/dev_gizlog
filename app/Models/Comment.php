<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'question_id',
        'comment',
    ];

    /**
    * @param void
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function question()
    {
        return $this->belongsTo('App\Models\Question');
    }

    /**
    * @param void
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}