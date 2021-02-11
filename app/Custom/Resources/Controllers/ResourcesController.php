<?php

namespace App\Custom\Resources\Controllers;

use App\Custom\Ajax\CustomAjaxController;
use App\Custom\Logging\AppLog;
use App\Custom\Resources\Services\ResourcesService;
use Illuminate\Http\Request;

abstract class ResourcesController extends CustomAjaxController {

    /**
     * @var ResourcesService
     */
    private $service;

    public function __construct(ResourcesService $service) {

        $this->service = $service;
    }

    public function updateResourcesSort(Request $request, $entityId) {
        try {
            $resourcesSortedIds = $request->input();
            $isSortedOk = $this->service->updateResourcesSort($resourcesSortedIds, $entityId);

            $hasErrors = $isSortedOk == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

}
