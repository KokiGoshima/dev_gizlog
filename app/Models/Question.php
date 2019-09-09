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
    public function tagCategory()
    {
        return $this->belongsTo('App\Models\TagCategory');
    }

   /**
    * @param int $category_num
    * @param int|string|null $search_word
    * @return Collection
    */
    public function getQuestionsWithSearch($category_num, $search_word)
    {
        $query = $this::query();
        $this->getQuestionsByCategory($query, $category_num);
        $this->getQuestionsByTitle($query, $search_word);
        return $query->orderBy('created_at', 'desc')
            ->with('comments')
            ->with('user')
            ->with('tagCategory')
            ->get();
    }


   /**
    * @param Illuminate\Database\Query\Builder $query int $category_num
    * @param int $category_num
    * @return Illuminate\Database\Query\Builder
    */
    public function getQuestionsByCategory($query, $category_num)
    {
        if ($category_num){
            $query->where('tag_category_id', $category_num);
        }
    }

   /**
    * @param Illuminate\Database\Query\Builder $query int $category_num
    * @param int|string|null $search_word
    * @return Illuminate\Database\Query\Builder
    */
    public function getQuestionsByTitle($query, $search_word)
    {
        if (isset($search_word)){
            $query->where('title', 'LIKE', '%'. $search_word .'%');
        }
    }

    /**
    * @param void
    * @return Collection
    */
    public function getAllQuestions()
    {
        return $this
            ->orderBy('created_at', 'desc')
            ->with('comments')
            ->with('user')
            ->with('tagCategory')
            ->get();
    }

}
