<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Question extends Model
{
    use SoftDeletes;

    protected $fillable = [
        'id',
        'user_id',
        'tag_category_id',
        'title',
        'content',
    ];

    /**
    * @param int $category_num
    * @return QuestionCollection
    */
    public function getQuestionsByCategory($category_num)
    {
        return $this
            ->where('tag_category_id', $category_num)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
    * @param int|string|null $searched_word
    * @return Collection
    */
    public function getQuestionsByTitleWord($searched_word, $category_num)
    {
        return $this
            ->where('title', 'LIKE', "%$searched_word%")
            ->where('tag_category_id', $category_num)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
    * @param int|string|null $searched_word, int $category_num
    * @return Collection
    */
    public function getQuestionsByTitleWordandCategory($searched_word, $category_num)
    {
        return $this
            ->where('title', 'LIKE', "%$searched_word%")
            ->where('tag_category_id', $category_num)
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
    * @param void
    * @return Collection
    */
    public function getAllQuestions()
    {
        return $this
            ->orderBy('created_at', 'desc')
            ->get();
    }

    /**
    * @param void
    * @return Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    /**
    * @param void
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
    * @param void
    * @return Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function tag_category()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }
}
