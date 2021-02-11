<?php

namespace App\Http\Controllers;

use App\Custom\Slug\Controllers\SlugController;
use App\ViewModelsServices\PageViewModelService;
use Illuminate\Http\Request;

class PagesController extends SlugController {

    /**
     * @var PageViewModelService
     */
    private $pageViewModelService;

    public function __construct(PageViewModelService $pageViewModelService) {
        $this->pageViewModelService = $pageViewModelService;
    }

    public function unknown() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.UNKNOWN'));
        return response()->view($model->viewPath, compact('model'), 404);
    }

    public function index() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.INDEX'));
        return view($model->viewPath, compact('model'));
    }

    public function cookie() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.COOKIE'));
        return view($model->viewPath, compact('model'));
    }

    public function privacy() {
        $model = $this->pageViewModelService->getViewModelByPageId(config('custom.pages.PRIVACY'));
        return view($model->viewPath, compact('model'));
    }



}
