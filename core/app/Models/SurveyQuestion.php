<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
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