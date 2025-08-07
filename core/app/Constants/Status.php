<?php

namespace App\Constants;

class Status {

   const ENABLE  = true;
   const DISABLE = false;

   const YES  = true;
   const NO = false;

   const ACTIVE_TXT  = 'Active';
   const INACTIVE_TXT = 'Inactive';

   const NPS = 'NPS';
   const STAR = 'Star';

   const GOOGLE_SCOPES  = [
      'https://www.googleapis.com/auth/business.manage', // Primary scope for Business Profile management
      'https://www.googleapis.com/auth/plus.business.manage' // Legacy scope, still useful for broader access
   ];

   const ASSET_VERSION = '?v=1.0.6';
}