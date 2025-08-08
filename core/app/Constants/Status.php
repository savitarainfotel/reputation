<?php

namespace App\Constants;

class Status {

   const ENABLE  = true;
   const DISABLE = false;

   const YES  = true;
   const NO = false;

   const ACTIVE_TXT  = 'Active';
   const INACTIVE_TXT = 'Inactive';

   const ALL_REVIEWS_TXT = 'All Reviews';
   const REVIEWS_WITH_TXT  = 'Reviews with text';
   const REVIEWS_WITHOUT_TXT  = 'Reviews without text (Rating only)';

   const MOST_RECENT_TXT = 'Most recent';
   const RATING_LOWEST_TXT  = 'Rating (lowest first)';
   const RATING_HIGHEST_TXT  = 'Rating (highest first)';

   const NPS = 'NPS';
   const STAR = 'Star';

   const GOOGLE_SCOPES  = [
      'https://www.googleapis.com/auth/business.manage', // Primary scope for Business Profile management
      'https://www.googleapis.com/auth/plus.business.manage' // Legacy scope, still useful for broader access
   ];

   const ASSET_VERSION = '?v=1.0.8';
}