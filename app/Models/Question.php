<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Auth;

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
    * @param int $categoryNum
    * @param int|string|null $searchWord
    * @return Collection
    */
    public function getQuestions($categoryNum, $searchWord)
    {
        return $this->searchByCategory($categoryNum)
            ->searchByTitle($searchWord)
            ->orderBy('created_at', 'desc')
            ->with(['comments', 'user', 'tagCategory'])
            ->get();
    }

   /**
    * @param Illuminate\Database\Query\Builder $query int $categoryNum
    * @param int $categoryNum
    * @return Illuminate\Database\Query\Builder
    */
    public function scopeSearchByCategory($query, $categoryNum)
    {
        if (!empty($categoryNum)){
            return $query->where('tag_category_id', $categoryNum);
        }
    }

   /**
    * @param Illuminate\Database\Query\Builder $query int $categoryNum
    * @param int|string|null $searchWord
    * @return Illuminate\Database\Query\Builder
    */
    public function scopeSearchByTitle($query, $searchWord)
    {
        if (!empty($searchWord)){
            return $query->where('title', 'LIKE BINARY', '%'. $searchWord .'%');
        }
    }

    /**
    * @param void
    * @return Collection
    */
    public function getUserQuestions($userId)
    {
        return $this->where('user_id', $userId)
            ->orderBy('created_at', 'desc')
            ->with(['comments', 'tagCategory'])
            ->get();
    }

}
