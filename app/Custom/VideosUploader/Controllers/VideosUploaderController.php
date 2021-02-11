<?php

namespace App\Custom\VideosUploader\Controllers;

use App\Custom\Ajax\CustomAjaxController;
use App\Custom\VideosUploader\Services\VideosUploaderService;
use App\Custom\Logging\AppLog;
use Illuminate\Http\Request;

abstract class ImagesUploaderController extends CustomAjaxController {

    /**
     * @var VideosUploaderService
     */
    private $service;

    public function __construct(VideosUploaderService $service) {

        $this->service = $service;
    }

    public function uploadVideo(Request $request, $entityId = null) {
        try {
            $videoUrl = $request->input("video-url");

            $savedVideoId = 0;
            if ($videoUrl != null) {
                $savedVideoId = $this->service->saveVideo($videoUrl, $entityId);
            }

            return $this->getResponseForAjaxCall(
                ["videoId" => $savedVideoId],
                $savedVideoId == null && $savedVideoId <= 0);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

    public function deleteVideo($entityId, $videoId) {
        try {
            $isDeleted = false;
            if ($entityId != null && $videoId != null) {
                $isDeleted = $this->service->deleteVideo($videoId, $entityId);
            }

            $hasErrors = $isDeleted == false;
            return $this->getResponseForAjaxCall(null, $hasErrors);
        } catch (\Exception $e) {
            AppLog::error($e);
            return $this->getResponseForAjaxCall(null, true);
        }
    }

}
