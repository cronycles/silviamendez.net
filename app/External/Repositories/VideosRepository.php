<?php
namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Video;

class VideosRepository extends Repository
{
    public function __construct(Video $video)
    {
        $this->modelClassName = $video;
    }

}
