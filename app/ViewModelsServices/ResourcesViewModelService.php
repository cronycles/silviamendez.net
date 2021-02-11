<?php

namespace App\ViewModelsServices;

use App\Custom\ImagesUploader\ViewModels\ImageViewModel;
use App\Custom\Resources\ViewModels\ResourceViewModel;
use App\Entities\ResourceEntity;

class ResourcesViewModelService {

    /**
     * @var VideosViewModelService
     */
    private $videosViewModelService;

    /**
     * @var ImagesViewModelService
     */
    private $imagesViewModelService;

    public function __construct(
        VideosViewModelService $videosViewModelService,
        ImagesViewModelService $imagesViewModelService) {

        $this->videosViewModelService = $videosViewModelService;
        $this->imagesViewModelService = $imagesViewModelService;
    }

    /**
     * @param ResourceEntity[] $imageEntities
     * @return ImageViewModel
     */
    public function createImageCoverFromResources($resourceEntities) {
        $outcome = null;
        if ($resourceEntities != null && !empty($resourceEntities)) {
            $foundImageEntity = null;
            /** @var ResourceEntity $resourceEntity */
            foreach ($resourceEntities as $resourceEntity) {
                if($resourceEntity->type == 1) {
                    $foundImageEntity = $resourceEntity;
                    break;
                }
            }
            if($foundImageEntity != null) {
                $outcome = $this->imagesViewModelService->createImageViewModel($foundImageEntity);
            }
        }
        if($outcome == null) {
            $outcome = $this->imagesViewModelService->getDefaultImage();
        }
        return $outcome;
    }

    /**
     * @param ResourceEntity[] $imageEntities
     * @return ResourceViewModel[]
     */
    public function createResourcesViewModel($resourceEntities) {
        $outcome = [];
        if ($resourceEntities != null && !empty($resourceEntities)) {
            /** @var ResourceEntity $resourceEntity */
            foreach ($resourceEntities as $resourceEntity) {
                $resourceViewModel = null;
                if($resourceEntity->type == 1) {
                    $resourceViewModel = $this->imagesViewModelService->createImageViewModel($resourceEntity);
                }
                elseif($resourceEntity->type == 2) {
                    $resourceViewModel = $this->videosViewModelService->createVideoViewModel($resourceEntity);
                }
                if($resourceViewModel != null) {
                    $resourceViewModel->type = $resourceEntity->type;
                    array_push($outcome, $resourceViewModel);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param ResourceEntity[] $imageEntities
     * @return ImagesViewModel[]
     */
    public function createJustAllImagesViewModelsFromResources($resourceEntities) {
        $outcome = [];
        if ($resourceEntities != null && !empty($resourceEntities)) {
            /** @var ResourceEntity $resourceEntity */
            foreach ($resourceEntities as $resourceEntity) {
                $resourceViewModel = null;
                if($resourceEntity->type == 1) {
                    $resourceViewModel = $this->imagesViewModelService->createImageViewModel($resourceEntity);
                }
                if($resourceViewModel != null) {
                    $resourceViewModel->type = $resourceEntity->type;
                    array_push($outcome, $resourceViewModel);
                }
            }
        }
        return $outcome;
    }

}
