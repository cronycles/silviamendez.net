<?php

namespace App\Services\Projects;

use App\Api\ProjectsApi;
use App\Entities\ProjectEntity;
use App\Entities\VideoEntity;

class ProjectsService  {

    /**
     * @var ProjectsApi
     */
    private $api;

    public function __construct(ProjectsApi $api) {
        $this->api = $api;
    }

    /**
     * @param $maxNumber int max number of items requested
     * @return ProjectEntity
     */
    public function getProjectById($id) {
        return $this->api->getProjectById($id);
    }

    /**
     * @param $maxNumber int max number of offers requested
     * @return ProjectEntity[]
     */
    public function getProjects($onlyVisible = true) {
        $outcome = [];
        $projects = $this->api->getProjects();
        if($projects != null && !empty($projects)) {
            /** @var ProjectEntity $project */
            foreach ($projects as $project) {
                if(!$onlyVisible || $project->isVisible) {
                    array_push($outcome, $project);
                }
            }
        }
        return $outcome;
    }

    /**
     * @return bool
     */
    public function saveProjectVideo($name, $url, $projectid) {
        $videoEntity = new VideoEntity();
        $videoEntity->name = $name;
        $videoEntity->url = $url;
        return $this->api->saveProjectVideo($videoEntity, $projectid);
    }

    /**
     * @return bool
     */
    public function deleteProjectVideo($videoId, $projectid) {
        return $this->api->deleteProjectVideo($videoId, $projectid);
    }

}
