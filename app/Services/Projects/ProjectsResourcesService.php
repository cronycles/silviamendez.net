<?php

namespace App\Services\Projects;

use App\Api\ProjectsApi;
use App\Custom\Resources\Services\ResourcesService;

class ProjectsResourcesService extends ResourcesService {

    public function __construct(ProjectsApi $api) {
        parent::__construct($api);
    }

}
