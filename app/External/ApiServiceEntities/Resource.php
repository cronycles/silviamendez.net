<?php

namespace App\External\ApiServiceEntities;

abstract class Resource {

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

}
