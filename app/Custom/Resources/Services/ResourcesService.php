<?php

namespace App\Custom\Resources\Services;

use App\Custom\Resources\Api\IResourcesApi;

abstract class ResourcesService {

    /**
     * @var IResourcesApi
     */
    protected $api;

    public function __construct(IResourcesApi $api) {
        $this->api = $api;
    }

    /**
     * @param array $resourcesSortedIds
     * @param int|null $entityId
     */
    public function updateResourcesSort(array $resourcesSortedIds, int $entityId = null) {
        return $this->api->updateResourcesSort($resourcesSortedIds, $entityId);
    }

    

}
