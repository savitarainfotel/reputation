<?php

namespace App\Models;

class Property extends BaseModel
{
    protected $casts = [
        'googleapis_log' => 'object',
    ];
}