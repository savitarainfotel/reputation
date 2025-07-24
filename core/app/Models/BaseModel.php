<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Traits\Hashidable;

abstract class BaseModel extends Model
{
    use Hashidable;
}