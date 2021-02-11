<?php

namespace App\Entities;

class ImageEntity extends ResourceEntity {

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;


    public function __construct() {
    }

}
