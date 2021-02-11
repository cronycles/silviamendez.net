<?php

namespace App\Custom\CRUD\ViewModels;

class CrudTableViewModel {

    /**
     * @var string
     */
    public $nameTitle;

    /**
     * @var string
     */
    public $editTitle;

    /**
     * @var string
     */
    public $imagesTitle;

    /**
     * @var string
     */
    public $videosTitle;

    /**
     * @var string
     */
    public $resourcesTitle;

    /**
     * @var string
     */
    public $deleteTitle;

    /**
     * @var boolean
     */
    public $isEditingEnabled;

    /**
     * @var boolean
     */
    public $isImagesEditingEnabled;

    /**
     * @var boolean
     */
    public $isVideosEditingEnabled;

    /**
     * @var boolean
     */
    public $isResourcesEditingEnabled;

    /**
     * @var boolean
     */
    public $isDeletingEnabled;

    /**
     * @var CrudTableItemViewModel[]
     */
    public $items;


    public function __construct() {
        $this->items = [];
        $this->nameTitle = __('crud-table.defaultNameTitle');
        $this->editTitle = __('crud-table.defaultEditTitle');
        $this->imagesTitle = __('crud-table.defaultImagesTitle');
        $this->resourcesTitle = __('crud-table.defaultResourcesTitle');
        $this->deleteTitle = __('crud-table.defaultDeleteTitle');

        $this->isEditingEnabled = false;
        $this->isImagesEditingEnabled = false;
        $this->isVideosEditingEnabled = false;
        $this->isResourcesEditingEnabled = false;
        $this->isImagesResourcesEditingEnabled = false;
        $this->isDeletingEnabled = false;
    }
}
