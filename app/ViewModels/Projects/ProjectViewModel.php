<?php

namespace App\ViewModels\Projects;

use App\ViewModels\Categories\CategoryViewModel;
use App\Custom\ImagesUploader\ViewModels\ImageViewModel;
use App\Custom\Resources\ViewModels\ResourceViewModel;

class ProjectViewModel {

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $description;

    /**
     * @var CategoryViewModel
     */
    public $category;

    /**
     * @var string
     */
    public $url;

    /**
     * @var ImageViewModel
     */
    public $cover;

    /**
     * @var ResourceViewModel[]
     */
    public $resources;

    /**
     * @var string
     */
    public $viewText;

    public function __construct() {
        $this->category = new CategoryViewModel();
        $this->resources = [];
    }

}
