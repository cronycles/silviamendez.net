<?php

namespace App\Custom\Resources\ViewModels;

abstract class ResourceViewModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $url;

    /**
     * @var string
     */
    public $type;

    public function __construct() {
    }

}
