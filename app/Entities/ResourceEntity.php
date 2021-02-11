<?php

namespace App\Entities;

use App\Custom\Entities\CustomEntity;

abstract class ResourceEntity extends CustomEntity {

     /**
     * @var int
     */
    public $resourceId;

    /**
     * @var int
     */
    public $id;

    /**
     * @var string
     */
    public $name;

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
