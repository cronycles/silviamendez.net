<?php

namespace App\ViewModelPageBuilders\Auth\Projects;

use App\Custom\Form\Helpers\FormHelper;
use App\Custom\VideosUploader\ViewModels\VideoViewModel;
use App\Entities\VideoEntity;
use App\Services\Projects\ProjectsService;
use App\ViewModelPageBuilders\Auth\AuthViewModelPageBuilder;
use App\ViewModels\Pages\Auth\Projects\AuthProjectVideoPageViewModel;
use App\ViewModelsServices\Auth\AuthProjectsViewModelService;

class AuthProjectVideosViewModelPageBuilder extends AuthViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $service;

    /**
     * @var AuthProjectsViewModelService
     */
    private $viewModelService;

     /**
     * @var FormHelper
     */
    private $formHelper;


    public function __construct(
        ProjectsService $service,
        AuthProjectsViewModelService $viewModelService,
        FormHelper $formHelper) {

        $this->formHelper = $formHelper;

        $this->service = $service;
        $this->viewModelService = $viewModelService;
    }

    public function createNewViewModel() {
        return new AuthProjectVideoPageViewModel();
    }

    /**
     * @param AuthProjectVideoPageViewModel $pageViewModel
     * @param array $params
     * @return AuthProjectVideoPageViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {

        $entity = $this->service->getProjectById($params['id']);

        $pageViewModel->projectId = $params['id'];

        /** @var VideoEntity $resource */
        foreach($entity->resources as $resource) {
            if($resource->type == 2) {
                $videoViewModel = new VideoViewModel() ;
                $videoViewModel->id = $resource->id;
                $videoViewModel->name = $resource->name;
                $videoViewModel->url = $resource->url;

                array_push($pageViewModel->videos, $videoViewModel);
            }
        }
        
        $pageViewModel->formData = $this->formHelper->createEmptyFormViewModelByConfiguration(
            config('custom.form.video'),
            route('auth.projects.videos.upload', $params['id']),
            __('page-auth-project-create.form.send'));

        return $pageViewModel;
    }
}
