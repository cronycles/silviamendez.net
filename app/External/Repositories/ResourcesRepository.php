<?php
namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Resource;

class ResourcesRepository extends Repository
{
    public function __construct(Resource $resource)
    {
        $this->modelClassName = $resource;
    }

}
