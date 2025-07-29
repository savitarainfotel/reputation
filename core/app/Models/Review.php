<?php

namespace App\Models;

use App\Constants\Status;

class Review extends BaseModel
{
    protected $casts = [
        'datetime' => 'datetime',
        'reply' => 'object',
    ];
}