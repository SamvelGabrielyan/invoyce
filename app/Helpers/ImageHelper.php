<?php

namespace App\Helpers;

use Illuminate\Support\Facades\File;

/**
 * Helper class for images.
 *
 * Class ImageHelper
 * @package App\Helpers
 */
class ImageHelper {

    /**
     * Checking if image height and width are in given range.
     *
     * @param $image
     * @return bool
     */
    public static function validateImageRatio($image)
    {
        list($width, $height) = getimagesize($image);

        if ($width > 250 || $height > 90) {
            return true;
        }

        return false;
    }

    /**
     * Uploading images.
     *
     * @since 1.0.1
     *
     * @param $file
     * @return string
     */
    public static function uploadImage($file)
    {
        $random_name     = time();
        $destinationPath = 'profile/';
        $extension       = $file->getClientOriginalExtension();
        $filename        = $random_name . '.' . $extension;
        $byte            = File::size($file); //get size of file

        $uploadSuccess = $file->move($destinationPath, $filename);

        return $filename;
    }
}
