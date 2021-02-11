<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectEditPageViewModel;
use App\ViewModels\Pages\Auth\Projects\AuthProjectsSortPageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectsResourcesSortViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $service;

    /**
     * @var AuthProjectsViewModelService
     */
    private $viewModelService;


    public function __construct(
        ProjectsService $service,
        AuthProjectsViewModelService $viewModelService) {

        $this->service = $service;
        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthProjectsSortPageViewModel();
    }

    /**
     * @param AuthProjectsSortPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectsSortPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $entity = $this->service->getProjectById($params['id']);

        $pageViewModel->sorting = $this->viewModelService->createResourcesSortingViewModel($entity);

        return $pageViewModel;
    }
}
