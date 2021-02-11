<?php

namespace App\Custom\ImagesUploader\ViewModels;

use App\Custom\Resources\ViewModels\ResourceViewModel;

class ImageViewModel extends ResourceViewModel {

    /**
     * @var string
     */
    public $name;

    /**
     * @var int
     */
    public $width;

    /**
     * @var int
     */
    public $height;

    /**
     * @var bool
     */
    public $isSmallViewEnabled;

    /**
     * @var bool
     */
    public $isMobile;

    public function __construct() {
        $this->isSmallViewEnabled = false;
        $this->isMobile = false;
    }

}
