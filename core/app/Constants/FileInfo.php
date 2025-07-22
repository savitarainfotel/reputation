<?php

namespace App\Constants;

class FileInfo
{

   /*
    |--------------------------------------------------------------------------
    | File Information
    |--------------------------------------------------------------------------
    |
    | This class basically contain the path of files and size of images.
    | All information are stored as an array. Developer will be able to access
    | this info as method and property using FileManager class.
    |
    */

    public function fileInfo(){
		    $data['property-images'] = [
            'path'       => 'assets/images/property-images/'
        ];

        return $data;
	}
}