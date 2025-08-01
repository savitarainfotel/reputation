<?php

namespace App\Models;

class SurveyQuestion extends BaseModel
{
    protected $fillable = [
        'question',
        'created_by',
        'updated_by',
    ];

    public function survey()
    {
        return $this->belongsTo(Survey::class);
    }
}