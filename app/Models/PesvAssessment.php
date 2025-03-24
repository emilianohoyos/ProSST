<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesvAssessment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'client_id',
        'application_level_id',
        'completed_at',
        'report_submitted_at',
        'evaluated_process',
        'path_work_plan',
        'path_improvement_plan_path',
        'number_vehicles',
        'state_id'
    ];
    
}
