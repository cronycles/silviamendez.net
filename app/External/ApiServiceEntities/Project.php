<?php

namespace App\External\ApiServiceEntities;

use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Entities\CategoryEntity;

class Project {

    /**
     * @var int
     */
    public $id;

    /**
     * @var CategoryEntity
     */
    public $category;

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $slug;

    /**
     * @var string
     */
    public $description;

    /**
     * @var Translation[]
     */
    public $descriptionTranslations;

    /**
     * @var bool
     */
    public $isVisible;

    /**
     * @var Resource[]
     */
    public $resources;

    public function __construct() {
        $this->resources = [];
        $this->descriptionTranslations = [];
        $this->category = new CategoryEntity();
    }

}
