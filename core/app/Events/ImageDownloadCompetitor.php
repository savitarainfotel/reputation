<?php

namespace App\Events;

use App\Models\Competitor;
use App\Models\CompetitorSetting;
use Illuminate\Support\Str;

class ImageDownloadCompetitor
{
    public $imagePath;
    public $competitor;
    public $competitorSetting;
    public $type;
    public $image;

    public function __construct(String $imagePath, Competitor $competitor, CompetitorSetting $competitorSetting, String $name = null, Array $type = ['competitor', 'competitorSetting'])
    {
        $this->imagePath = $imagePath;
        $this->competitor = $competitor;
        $this->competitorSetting = $competitorSetting;
        $this->type = $type;
        $this->image = Str::slug($name ?? $competitor->name);
    }
}