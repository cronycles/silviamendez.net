<?php

namespace App\Custom\VideosUploader\Services;

use App\Custom\VideosUploader\Api\IVideosUploaderApi;
use App\Custom\Logging\AppLog;

abstract class VideosUploaderService {

    /**
     * @var IVideosUploaderApi
     */
    protected $api;

    public function __construct(IVideosUploaderApi $api) {
        $this->api = $api;
    }

    public function saveVideo(string $videoUrl, int $id = null) {
        try {
            $outcome = null;

            $savedVideoId = $this->api->saveVideo($videoUrl, $id);

            if ($savedVideoId != null && $savedVideoId > 0) {
                $outcome = $savedVideoId;
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param int $videoId
     * @param int|null $entityId
     * @return bool
     */
    public function deleteVideo(int $videoId, int $entityId = null) {
        try {
            $outcome = false;
            if ($videoId != null) {
                $outcome = $this->api->deleteVideo($videoId, $entityId);
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

}
