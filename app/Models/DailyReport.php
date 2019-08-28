<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class DailyReport extends Model
{
    use SoftDeletes;

    protected $table = 'daily_reports';
    protected $dates = ['deleted_at'];

    protected $fillable = [
        'user_id',
        'title',
        'content',
        'reporting_time',
        'deleted_at',
    ];
}
