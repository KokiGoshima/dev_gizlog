<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at', 'reporting_time'];
    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
    ];

    /**
    * @param integer $id
    * @return Collection
    */
    public function getAllReport($id){
        return $this->where('user_id', $id)
            ->orderBy('reporting_time', 'desc')
            ->get();
    }

    /**
    * @param integer $id
    * @param String $searchedMonth xxxx-xxの形で
    * @return Collection
    */
    public function getReportByMonth($id, $searchedMonth){
        return $this->where('user_id', $id)
            ->where('reporting_time', 'LIKE', "%{$searchedMonth}%")
            ->orderBy('reporting_time', 'desc')
            ->get();
    }
}
