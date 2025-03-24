<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PesvAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'pesv_assessment_id',
        'pesv_question_id',
        'qualification_id',
        'observation'
    ];
}
