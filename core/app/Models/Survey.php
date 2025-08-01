<?php

namespace App\Models;

class Survey extends BaseModel
{
    public function questions()
    {
        return $this->hasMany(SurveyQuestion::class);
    }
}