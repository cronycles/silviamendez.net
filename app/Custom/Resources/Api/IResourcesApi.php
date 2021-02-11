<?php

namespace App\Custom\Resources\Api;

interface IResourcesApi {

    /**
     * @param int|null $entityId
     * @param array $resourcesSortedIds
     * @return bool
     */
    public function updateResourcesSort(array $resourcesSortedIds, int $entityId);

}
