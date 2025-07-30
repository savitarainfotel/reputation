<?php

namespace App\Events;

use Illuminate\Queue\SerializesModels;
use App\Models\CompetitorSetting;
use App\Models\Competitor;

class ReviewsCountScrapeCompetitor
{
    use SerializesModels;

    public $competitorSetting;
    public $competitor;

    public function __construct(Competitor $competitor, CompetitorSetting $competitorSetting)
    {
        $this->competitor = $competitor;
        $this->competitorSetting = $competitorSetting;
    }
}