<?php

namespace App\Helper;

use Cloudder;

class CloudinaryHelper
{
    public static function saveImageInClouder($file)
    {
        return $res = Cloudder::upload($file, null, [], []);
    }

    public static function deleteImageFromCloudinary($imagePublicId)
    {
        Cloudder::destroyImages([$imagePublicId], []);
    }
}
