<?php

namespace App\External\Repositories;

use App\Custom\Api\Repositories\Repository;
use App\Custom\Logging\AppLog;
use App\Image;
use App\Project;
use App\Resource;
use App\Video;
use Illuminate\Support\Facades\DB;

class ProjectsRepository extends Repository {
    public function __construct(Project $project) {
        $this->modelClassName = $project;
    }

    public function all() {
        return $this->modelClassName
            ->orderByRaw('ISNULL(order_number), order_number asc')
            ->get();
    }

    public function destroy($id){
        try {
            DB::beginTransaction();
            DB::table('images')
            ->join('resources', 'images.id', '=', 'resources.image_id')
            ->join('project_resource', 'resources.id', '=', 'project_resource.resource_id')
            ->join('projects', 'projects.id', '=', 'project_resource.project_id')
            ->where('project_id', '=', $id)
            ->delete();
            
            DB::table('videos')
            ->join('resources', 'videos.id', '=', 'resources.video_id')
            ->join('project_resource', 'resources.id', '=', 'project_resource.resource_id')
            ->join('projects', 'projects.id', '=', 'project_resource.project_id')
            ->where('project_id', '=', $id)
            ->delete();
            
            DB::commit();
            parent::destroy($id);
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return false;
        }
    }

    

    /**
     * @param Image $dbImageEntity
     * @param int $projectId
     * @return int
     */
    public function saveImageToProject(Image $dbImageEntity, int $projectId) {
        try {
            $outcome = 0;
            /** @var Project $dbProject */
            $dbProject = $this->find($projectId);
            DB::beginTransaction();
            $isImageSaved = $dbImageEntity->save();
            if ($isImageSaved && $dbImageEntity->id > 0) {
                $dbResourceEntity = new Resource();
                $dbResourceEntity->resource_type_id = 1;
                $dbResourceEntity->image_id = $dbImageEntity->id;
                $isResourceSaved = $dbResourceEntity->save();
                if ($isResourceSaved && $dbResourceEntity->id > 0) {
                    $dbProject->resources()->attach($dbResourceEntity->id);
                    DB::commit();
                    $outcome = $dbImageEntity->id;
                }
            }
            else {
                DB::rollBack();
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return 0;
        }
    }

    /**
     * @param array $sortedIds
     */
    public function updateSort(array $sortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($sortedIds); $i++) {
                $sortedId = $sortedIds[$i];
                $newOder = $i + 1;

                DB::table('projects')
                    ->where('id', '=', $sortedId)
                    ->update([
                        'order_number' => $newOder
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param int $projectId
     * @param array $resourcesSortedIds
     * @return bool
     */
    public function updateResourcesSort(int $projectId, array $resourcesSortedIds) {
        try {
            DB::beginTransaction();

            for ($i = 0; $i< count($resourcesSortedIds); $i++) {
                $sortedId = $resourcesSortedIds[$i];
                $newOder = $i + 1;

                DB::table('project_resource')
                    ->where('project_id', '=', $projectId)
                    ->where('resource_id', '=', $sortedId)
                    ->update([
                        'resource_order' => $newOder
                    ]);
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return false;
        }
    }

    /**
     * @param Video $dbVideoModel
     * @param int $projectId
     * @return int
     */
    public function saveVideoToProject(Video $dbVideoModel, int $projectId) {
        try {
            $outcome = 0;
            /** @var Project $dbProject */
            $dbProject = $this->find($projectId);
            DB::beginTransaction();
            $isVideoSaved = $dbVideoModel->save();
            if ($isVideoSaved && $dbVideoModel->id > 0) {
                $dbResourceEntity = new Resource();
                $dbResourceEntity->resource_type_id = 2;
                $dbResourceEntity->video_id = $dbVideoModel->id;
                $isResourceSaved = $dbResourceEntity->save();
                if ($isResourceSaved && $dbResourceEntity->id > 0) {
                    $dbProject->resources()->attach($dbResourceEntity->id);
                    DB::commit();
                    $outcome = $dbVideoModel->id;
                }
            }
            else {
                DB::rollBack();
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            DB::rollBack();
            return 0;
        }
    }
}
