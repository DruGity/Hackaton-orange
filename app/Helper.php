<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Cloudder;

class Helper extends Model
{
    public function saveImageInClouder($file)
    {
        return $res = Cloudder::upload($file, null, [], []);
    }

}
