<?php

namespace App\Http\Controllers\Auth\Projects;

use App\Custom\Resources\Controllers\ResourcesController;
use App\Services\Projects\ProjectsResourcesService;

class AuthProjectsResourcesController extends ResourcesController {

    public function __construct(ProjectsResourcesService $service) {
        parent::__construct($service);
    }


}
