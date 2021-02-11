<?php

namespace App\ViewModelsServices;

use App\Entities\VideoEntity;
use App\Custom\VideosUploader\ViewModels\VideoViewModel;

class VideosViewModelService {

    public function __construct() {
    }

    /**
     * @param VideoEntity $imageEntity
     * @return VideoViewModel
     */
    public function createVideoViewModel(VideoEntity $entity) {
        $outcome = null;
        if ($entity != null) {
            $outcome = new VideoViewModel();
            $outcome->id = $entity->id;
            $outcome->url = $entity->url;
        }
        return $outcome;
    }

}
