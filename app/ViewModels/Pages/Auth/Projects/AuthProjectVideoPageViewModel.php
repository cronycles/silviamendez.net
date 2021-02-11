<?php

namespace App\ViewModels\Pages\Auth\Projects;

use App\Custom\Form\Models\FormModel;
use App\Custom\VideosUploader\ViewModels\VideoViewModel;
use App\ViewModels\Pages\Auth\AuthPageViewModel;

class AuthProjectVideoPageViewModel extends AuthPageViewModel {

    /**
     * @var VideoViewModel[]
     */
    public $videos;

    /**
     * @var FormModel
     */
    public $formData;

    public $projectId;

    public function __construct() {
        parent::__construct();
        $this->videos = [];
    }

}
