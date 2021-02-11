<?php

namespace App\Entities;


use App\Custom\Entities\CustomEntity;
use App\Custom\Translations\Entities\TranslationEntity;

class ProjectEntity extends CustomEntity{

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
     * @var TranslationEntity[]
     */
    public $descriptionTranslations;

    /**
     * @var bool
     */
    public $isVisible;

    /**
     * @var ResourceEntity[]
     */
    public $resources;

    public function __construct() {
        $this->category = new CategoryEntity();
        $this->descriptionTranslations = [];
        $this->resources = [];
    }

}
