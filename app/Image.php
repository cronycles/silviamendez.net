<?php

namespace App;

use Illuminate\Database\Eloquent\Model;


/**
 * Class Category
 * @package App
 *
 * @property int $id
 * @property string $name
 * @property int $size
 * @property int $width
 * @property int $height
 */
class Image extends Model {
    protected $fillable = [
    ];
}
