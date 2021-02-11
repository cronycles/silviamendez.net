<?php

namespace App\Http\Controllers\Auth\Projects;

use App\Custom\HttpMessages\Services\HttpMessagesService;
use App\Services\Projects\ProjectsService;
use Illuminate\Http\Request;

class AuthProjectsVideosController {

    /**
     * @var HttpMessagesService
     */
    private $messagesService;

    /**
     * @var ProjectsService
     */
    private $service;

    public function __construct(ProjectsService $service) {
        $this->messagesService = new HttpMessagesService();
        $this->service = $service;
    }

    public function uploadVideo(Request $request, int $id) {
        $name = $request->name;
        $url = $request->url;

        $outcome = $this->service->saveProjectVideo($name, $url, $id);

        if($outcome != null) {
            $outcome = $this->messagesService->createSuccessResponse('super!');

        }
        else {
            $outcome = $this->messagesService->createResponseWithGenericError();
        }

        return $outcome;
    }

    public function deleteVideo(Request $request, $id) {
        
        $videoId = $request->videoId;

        $outcome =  $this->service->deleteProjectVideo($videoId, $id);

        if($outcome != null) {
            $outcome = $this->messagesService->createSuccessResponse('super!');

        }
        else {
            $outcome = $this->messagesService->createResponseWithGenericError();
        }

        return $outcome;
    }


}
