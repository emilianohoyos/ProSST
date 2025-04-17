<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class WorkPlan extends Model
{
    protected $fillable = [
        'start_date',
        'end_date',
        'preparation_date',
        'name_president_committee',
        'reviewed_by',
        'approved_by',
        'objective',
        'meta_description',
        'meta_numeric',
        'user_id',
        'client_id',
        'application_level_id',
        'pesv_assessment_id'
    ];
}
