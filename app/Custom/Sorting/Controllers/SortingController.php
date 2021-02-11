<?php


namespace App\Custom\Sorting\Controllers;

use App\Custom\Ajax\CustomAjaxController;
use App\Custom\Sorting\Services\SortingService;
use Illuminate\Http\Request;

abstract class SortingController extends CustomAjaxController {

    /**
     * @var SortingService
     */
    private $service;

    public function __construct(SortingService $service) {

        $this->service = $service;
    }

    public function updateSort(Request $request) {
        $sortedIds = $request->input();
        $this->service->updateSort($sortedIds);
    }

}
