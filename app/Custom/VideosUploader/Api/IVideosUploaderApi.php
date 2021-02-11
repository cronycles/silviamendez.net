<?php

namespace App\Custom\VideosUploader\Api;

interface IVideosUploaderApi {

    /**
     * @param int $entityId
     * @param string $file
     * @return int|null
     */
    public function saveVideo(string $video, int $entityId);

    /**
     * @param int|null $entityId
     * @param int $videoId
     * @return bool
     */
    public function deleteVideo(int $videoId, int $entityId = null);

}
