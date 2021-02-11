<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

/**
 * Class Category
 * @package App
 *
 * @property int $id
 * @property int $resource_type_id
 * @property Image $image
 * @property Video $video
 */
class Resource extends Model {
    protected $fillable = [
    ];


    public function image() {
        return $this->hasOne('App\Image', "id", "image_id");
    }

    public function video() {
        return $this->hasOne('App\Video', "id", "video_id");
    }
}
