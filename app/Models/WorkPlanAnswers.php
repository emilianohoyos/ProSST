<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WorkPlanAnswers extends Model
{
    use HasFactory;

    protected $fillable = [
        'work_plan_id',
        'work_plan_activity_id',
        'month_1',
        'month_2',
        'month_3',
        'month_4',
        'month_5',
        'month_6',
        'month_7',
        'month_8',
        'month_9',
        'month_10',
        'month_11',
        'month_12',
        'resource_physical',
        'resource_economic',
        'resource_human',
        'follow_up'
    ];
}
