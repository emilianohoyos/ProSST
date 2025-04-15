<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesvImprovementPlanAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesv_assessment_id',
        'pesv_question_id',
        'people_to_be_informed',
        'channel_diffusion_improvement_action',
        'observation',
        'execution_date',
        'status_action_id',
        'improvement_action_id',
        'pesv_cause_improvement_plan_id',
        'user_id',
        'action_type_id'
    ];
}
