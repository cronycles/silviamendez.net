<?php

namespace App\External\ApiServices;

use App\Custom\ImagesUploader\Helpers\ImagesHelper;
use App\Custom\Logging\AppLog;
use App\Custom\Slug\Helpers\SlugHelper;
use App\Custom\Translations\ApiServiceEntities\Translation;
use App\Entities\VideoEntity;
use App\External\ApiServiceEntities\CarouselImage;
use App\External\ApiServiceEntities\Category;
use App\External\ApiServiceEntities\Language;
use App\External\ApiServiceEntities\Project;
use App\External\ApiServiceEntities\User;
use App\External\Repositories\CarouselImagesRepository;
use App\External\Repositories\CategoriesRepository;
use App\External\Repositories\ImagesRepository;
use App\External\Repositories\LocalesRepository;
use App\External\Repositories\ProjectsRepository;
use App\External\Repositories\ResourcesRepository;
use App\External\Repositories\UsersRepository;
use App\External\Repositories\VideosRepository;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use Image;

class PublicApiService {

    /**
     * @var UsersRepository
     */
    private $usersRepository;

    /**
     * @var LocalesRepository
     */
    private $localesRepository;

    /**
     * @var ProjectsRepository
     */
    private $projectsRepository;

    /**
     * @var CategoriesRepository
     */
    private $categoriesRepository;

     /**
     * @var ResourcesRepository
     */
    private $resourcesRepository;

    /**
     * @var ImagesRepository
     */
    private $imagesRepository;

    /**
     * @var VideosRepository
     */
    private $videosRepository;

    /**
     * @var ImagesHelper
     */
    private $imageService;

    /**
     * @var CarouselImagesRepository
     */
    private $carouselImagesRepository;

    /**
     * @var SlugHelper
     */
    private $slugHelper;

    public function __construct(
        UsersRepository $usersRepository,
        LocalesRepository $localesRepository,
        ProjectsRepository $projectsRepository,
        CategoriesRepository $categoriesRepository,
        CarouselImagesRepository $carouselImagesRepository,
        ResourcesRepository $resourcesRepository,
        ImagesRepository $imagesRepository,
        VideosRepository $videosRepository,
        ImagesHelper $imageService,
        SlugHelper $slugHelper) {

        $this->usersRepository = $usersRepository;
        $this->localesRepository = $localesRepository;
        $this->projectsRepository = $projectsRepository;
        $this->categoriesRepository = $categoriesRepository;
        $this->carouselImagesRepository = $carouselImagesRepository;
        $this->resourcesRepository = $resourcesRepository;
        $this->imagesRepository = $imagesRepository;
        $this->videosRepository = $videosRepository;
        $this->imageService = $imageService;
        $this->slugHelper = $slugHelper;
    }

    /**
     * @param int $userId
     * @return User
     */
    public function getUserById(int $userId) {
        try {
            $outcome = null;

            if ($userId != null && $userId > 0) {
                /** @var \App\User $dbUser */
                $dbUser = $this->usersRepository->find($userId);
                $outcome = $this->createUserEntityByDbModel($dbUser);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @return Language[]
     */
    public function getLanguages() {
        try {
            $outcome = [];

            /** @var array $dbLocales */
            $dbLocales = $this->localesRepository->all();

            if ($dbLocales != null && !empty($dbLocales)) {
                /** @var \App\Locale $dbLocale */
                foreach ($dbLocales as $dbLocale) {
                    $entity = $this->createLanguageEntityByDbModel($dbLocale);
                    if ($entity != null) {
                        array_push($outcome, $entity);
                    }
                }
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @return \App\External\ApiServiceEntities\CarouselImage[]
     */
    public function getCarouselImages() {
        try {
            $outcome = [];

            $dbEntities = $this->carouselImagesRepository->all();

            if ($dbEntities != null && !empty($dbEntities)) {
                /** @var \App\CarouselImage $dbEntities */
                foreach ($dbEntities as $dbEntity) {
                    $entity = $this->createCarouselImageEntityByDbModel($dbEntity);
                    if ($entity != null) {
                        array_push($outcome, $entity);
                    }
                }
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param $maxNumber int max number of services requested
     * @return Category[]
     */
    public function getCategories($maxNumber = null) {
        try {
            $outcome = [];

            /** @var array $dbCategories */
            $dbCategories = $maxNumber != null
                ? $this->categoriesRepository->all()->take($maxNumber)
                : $this->categoriesRepository->all();

            if ($dbCategories != null && !empty($dbCategories)) {
                /** @var \App\Category $dbCategory */
                foreach ($dbCategories as $dbCategory) {
                    $entity = $this->createCategoryEntityByDbModel($dbCategory);
                    if ($entity != null) {
                        array_push($outcome, $entity);
                    }
                }
            }

            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param $id int id of category requested
     * @return Category
     */
    public function getCategoryById($id) {
        try {
            $outcome = null;

            if ($id != null && $id > 0) {
                /** @var \App\Category $dbCategory */
                $dbCategory = $this->categoriesRepository->find($id);
                $outcome = $this->createCategoryEntityByDbModel($dbCategory);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createCategoryDbModelByServiceEntity($categoryEntity);
        if ($category != null) {
            $outcome = $category->save();
        }
        return $outcome;
    }

    public function updateCategory(Category $categoryEntity) {
        $outcome = false;
        $category = $this->createCategoryDbModelByServiceEntity($categoryEntity);
        if ($category != null) {
            $outcome = $category->update();
        }
        return $outcome;
    }

    public function deleteCategory(int $id) {
        return $this->categoriesRepository->destroy($id);
    }

    /**
     * @param array[int] $sortedIds
     */
    public function updateCategoriesSort(array $sortedIds) {
        return $this->categoriesRepository->updateSort($sortedIds);
    }

    /**
     * @param $maxNumber int max number of services requested
     * @return Project[]
     */
    public function getProjects($maxNumber = null) {
        try {
            $outcome = [];

            $dbProjects = $maxNumber != null
                ? $this->projectsRepository->all()->take($maxNumber)
                : $this->projectsRepository->all();

            if ($dbProjects != null && !empty($dbProjects)) {
                /** @var \App\Project $dbProject */
                foreach ($dbProjects as $dbProject) {
                    $entity = $this->createProjectEntityByDbModel($dbProject);
                    if ($entity != null) {
                        array_push($outcome, $entity);
                    }
                }
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param $id int id of project requested
     * @return Project
     */
    public function getProjectById($id) {
        try {
            $outcome = null;

            if ($id != null && $id > 0) {
                /** @var \App\Project $dbProject */
                $dbProject = $this->projectsRepository->find($id);
                $outcome = $this->createProjectEntityByDbModel($dbProject);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    public function storeProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createProjectDbModelByServiceEntity($projectEntity);
        if ($project != null) {
            $outcome = $project->save();
        }
        return $outcome;
    }

    public function updateProject(Project $projectEntity) {
        $outcome = false;
        $project = $this->createProjectDbModelByServiceEntity($projectEntity);
        if ($project != null) {
            $outcome = $project->update();
        }
        return $outcome;
    }

    public function deleteProject(int $id) {
        try {
            /** @var \App\Project $dbProject */
            $dbProject = $this->projectsRepository->find($id);
            $resourcesDbModels = $dbProject->resources;
            $imageNames = [];
            /** @var \App\Resource $resourceDbModel */
            if(isset($resourcesDbModels) && $resourcesDbModels != null) {
                foreach($resourcesDbModels as $resourceDbModel) {
                    if($resourceDbModel->resource_type_id == 1) {
                        $imageDbModel = $resourceDbModel->image;
                        array_push($imageNames, $imageDbModel->name);
                    }
                }
                $isDeletedFromDb = $this->projectsRepository->destroy($id);
                if($isDeletedFromDb) {
                    foreach($imageNames as $imageName) {
                        $this->deleteImageFromDisk($imageName);
                    }
                }
            }
            return true;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param array[int] $sortedIds
     */
    public function updateProjectsSort(array $sortedIds) {
        return $this->projectsRepository->updateSort($sortedIds);
    }

    public function saveProjectImage(int $projectId, UploadedFile $file) {
        try {
            $outcome = null;

            $fileName = $this->imageService->createNewJpgFileName($file);
            if ($fileName != null && !empty($fileName)) {
                $image = Image::make($file->getRealPath());
                if ($image != null) {
                    $dbImageEntity = $this->createImageDbEntity($image, $fileName);
                    $imageId = $this->projectsRepository->saveImageToProject($dbImageEntity, $projectId);
                    if($imageId > 0 ) {
                        $savedImage = $this->saveImageToDisk($image, $fileName);
                        $outcome = $imageId;
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            $this->deleteImageFromDisk($fileName);
            return null;
        }
    }

    public function deleteProjectImage(int $projectId, int $imageId) {
        try {
            $outcome = false;

            if ($projectId != null && $imageId != null) {
                $imageDbEntity = $this->imagesRepository->find($imageId);
                if($imageDbEntity != null) {
                    $isDeletedFromDb = $this->imagesRepository->destroy($imageId);
                    if($isDeletedFromDb) {
                        $outcome = true;
                        $isDeletedFromDisk = $this->deleteImageFromDisk($imageDbEntity->name);
                        if(!$isDeletedFromDisk) {
                            AppLog::errorMessage("l'immagine " . $imageId . " non si é potuta eliminare dal disco ma si dal DB");
                        }
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param int $projectId
     * @param array $resourcesSortedIds
     * @return bool
     */
    public function updateProjectResourcesSort(int $projectId, array $resourcesSortedIds) {
        return $this->projectsRepository->updateResourcesSort($projectId, $resourcesSortedIds);
    }

    public function saveHomeSlidesImage(UploadedFile $file) {
        try {
            $outcome = null;
            $dbModel = $this->createHomeSlidesModel();
            $fileName = $this->imageService->createNewJpgFileName($file);
            if (!empty($fileName)) {
                $image = Image::make($file->getRealPath());
                if ($image != null) {
                    $dbImageEntity = $this->createImageDbEntity($image, $fileName);
                    $imageId = $this->carouselImagesRepository->saveHomeSlide($dbModel, $dbImageEntity);
                    if($imageId > 0 ) {
                        $savedImage = $this->saveImageToDisk($image, $fileName, config('custom.images.uploadedHomeSlidesPath'));
                        $outcome = $imageId;
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            $this->deleteImageFromDisk($fileName, config('custom.images.uploadedHomeSlidesPath'));
            return null;
        }
    }

    public function deleteHomeSlidesImage(int $imageId) {
        try {
            $outcome = false;
            if ($imageId != null) {
                $imageDbEntity = $this->imagesRepository->find($imageId);
                if($imageDbEntity != null) {
                    $isDeletedFromDb = $this->imagesRepository->destroy($imageId);
                    if($isDeletedFromDb) {
                        $outcome = true;
                        $isDeletedFromDisk = $this->deleteImageFromDisk($imageDbEntity->name, config('custom.images.uploadedHomeSlidesPath'));
                        if(!$isDeletedFromDisk) {
                            AppLog::errorMessage("l'immagine " . $imageId . " non si é potuta eliminare dal disco ma si dal DB");
                        }
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param array $imagesSortedIds
     * @return bool
     */
    public function updateHomeSlidesImagesSort(array $imagesSortedIds) {
        return $this->carouselImagesRepository->updateImagesSort($imagesSortedIds);
    }

    /**
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function changeHomeSlidesIsMobileProperty(int $imageId, bool $value = true) {
        return $this->carouselImagesRepository->changeHomeSlidesIsMobileProperty($imageId, $value);
    }


     /**
     * @param array $imagesSortedIds
     * @return bool
     */
    public function saveProjectVideo($videoEntity, $projectId) {
        try {
            $outcome = null;

            if ($videoEntity != null && $projectId != null) {
                
                $dbVideoModel = $this->createVideoDbModel($videoEntity);
                $videoId = $this->projectsRepository->saveVideoToProject($dbVideoModel, $projectId);
                if($videoId > 0 ) {
                    $outcome = $videoId;
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return null;
        }
    }

    /**
     * @param int $imageId
     * @param bool $value
     * @return bool
     */
    public function deleteProjectVideo($videoId, $projectId) {
        try {
            $outcome = false;

            if ($projectId != null && $videoId != null) {
                $videoDbModel = $this->videosRepository->find($videoId);
                if($videoDbModel != null) {
                    $isDeletedFromDb = $this->videosRepository->destroy($videoId);
                    if($isDeletedFromDb) {
                        $outcome = true;
                    }
                }
            }

            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param \Intervention\Image\Image $image
     * @param $fileName
     * @param string|null $diskPath
     * @return \Intervention\Image\Image|null
     */
    private function saveImageToDisk(\Intervention\Image\Image $image, $fileName, string $diskPath = null) {
        try {
            $outcome = null;
            if ($image != null || $fileName != null) {
                if ($image != null) {
                    $diskPath = $diskPath != null ? $diskPath : config('custom.images.uploadedImagePath');
                    $image = $this->resizeImageIfRequired($image);
                    $this->createPathIfNotExists($diskPath);
                    $filePath = $this->getRealFilePathFromName($diskPath, $fileName);
                    $outcome = $image->save($filePath, 100, 'jpg');
                }
            }
            return $outcome;
        } catch (\Exception $e) {
            AppLog::error($e);
            $this->deleteImageFromDisk($fileName, $diskPath);
            return $outcome;
        }

    }

    private function deleteImageFromDisk($fileName, string $diskPath = null) {
        try {
            $outcome = false;
            $diskPath = $diskPath != null ? $diskPath : config('custom.images.uploadedImagePath');
            $filePath = $this->getRealFilePathFromName($diskPath, $fileName);
            if (file_exists($filePath)) {
                $outcome = unlink($filePath);
            }
            return $outcome;

        } catch (\Exception $e) {
            AppLog::error($e);
            return false;
        }
    }

    /**
     * @param \App\User|null $dbUser
     * @return User
     */
    private function createUserEntityByDbModel($dbUser) {
        $outcome = new User();
        if ($dbUser != null) {
            $outcome->id = $dbUser->id;
            $outcome->name = $dbUser->name;
            $outcome->email = $dbUser->email;
        }
        return $outcome;
    }

    /**
     * @param \App\Locale|null $dbLocale
     * @return Language
     */
    private function createLanguageEntityByDbModel($dbLocale) {
        $outcome = new Language();
        if ($dbLocale != null) {
            $outcome->code = $dbLocale->code;
            $outcome->cultureCode = $dbLocale->culture_code;
            $outcome->name = $dbLocale->name;
            $outcome->isDefault = $dbLocale->default;
            $outcome->isVisible = $dbLocale->visible;
            $outcome->isAuthVisible = $dbLocale->auth_visible;
        }
        return $outcome;
    }

    /**
     * @return Translation[]
     */
    private function createTranslationEntitiesByDbModel($databaseEntity, string $translatableItemName) {
        $outcome = [];

        $languages = $this->getLanguages();
        foreach ($languages as $language) {
            $translation = $databaseEntity->getTranslation($translatableItemName, $language->code);
            $translationModel = new Translation($language->code, $translation);
            array_push($outcome, $translationModel);
        }
        return $outcome;
    }

    /**
     * @param \App\Category $dbCategory
     * @return Category
     */
    private function createCategoryEntityByDbModel(\App\Category $dbCategory) {
        $outcome = new Category();
        if ($dbCategory != null) {
            $outcome->id = $dbCategory->id;
            $outcome->name = $dbCategory->name;
            $outcome->nameTranslations = $this->createTranslationEntitiesByDbModel($dbCategory, 'name');
        }

        return $outcome;
    }


    /**
     * @param Category $categoryEntity
     * @return \App\Category
     */
    private function createCategoryDbModelByServiceEntity(Category $categoryEntity) {
        $outcome = null;
        if ($categoryEntity != null) {
            if ($categoryEntity->id > 0) {
                /** @var \App\Category $outcome */
                $outcome = $this->categoriesRepository->find($categoryEntity->id);
            } else {
                /** @var \App\Category $outcome */
                $outcome = new \App\Category();
            }

            if ($outcome != null) {
                foreach ($categoryEntity->nameTranslations as $nameTranslation) {
                    $outcome->setTranslation('name', $nameTranslation->locale, $nameTranslation->value);
                }
            }
        }
        return $outcome;
    }

    /**
     * @param \App\CarouselImage $dbEntity
     * @return CarouselImage
     */
    private function createCarouselImageEntityByDbModel(\App\CarouselImage $dbEntity) {
        $outcome = new CarouselImage();

        if ($dbEntity != null) {
            $outcome->id = $dbEntity->id;
            $outcome->orderNumber = $dbEntity->order_number;
            $outcome->isMobile = $dbEntity->is_mobile;

            $dbResource = $dbEntity->image;
            if($dbResource != null) {
                $imageEntity = new \App\External\ApiServiceEntities\Image();
                $imageEntity->id = $dbResource->id;
                $imageEntity->name = $dbResource->name;
                $imageEntity->width = $dbResource->width;
                $imageEntity->height = $dbResource->height;
                $imageEntity->url = config('custom.images.uploadedHomeSlidesUrl') . "/" . $dbResource->name;
                $outcome->image = $imageEntity;
            }

        }

        return $outcome;
    }

    /**
     * @param \App\Project $dbProject
     * @return Project
     */
    private function createProjectEntityByDbModel(\App\Project $dbProject) {
        $outcome = new Project();

        if ($dbProject != null) {
            $outcome->id = $dbProject->id;
            $outcome->title = $dbProject->title;
            $outcome->slug = $this->slugHelper->addIdToSlug($dbProject->slug, $dbProject->id);
            $outcome->description = $dbProject->description;
            $outcome->descriptionTranslations = $this->createTranslationEntitiesByDbModel($dbProject, 'description');
            $category = new Category();
            $category->id = $dbProject->category->id;
            $category->name = $dbProject->category->name;
            $category->orderNumber = $dbProject->category->order_number;
            $outcome->category = $category;
            $outcome->isVisible = $dbProject->show ? true : false;

            $dbResources = $dbProject->resources;
            /** @var \App\Resource $dbResource */
            foreach ($dbResources as $dbResource) {
                if($dbResource != null) {
                    $resourceEntity = null;
                    if($dbResource->resource_type_id == 1) {
                        $imageDbModel = $dbResource->image;
                        $resourceEntity = $this->createImageEntityByDbModel($imageDbModel);
                        $resourceEntity->type = 1;
                    }
                    elseif($dbResource->resource_type_id == 2) {
                        $videoDbModel = $dbResource->video;
                        $resourceEntity = $this->createVideoEntityByDbModel($videoDbModel);
                        $resourceEntity->type = 2;
                    }
                    if($resourceEntity != null) {
                        $resourceEntity->type = $dbResource->resource_type_id;
                        $resourceEntity->resourceId = $dbResource->id;
                        array_push($outcome->resources, $resourceEntity);
                    }
                }
            }
        }

        return $outcome;
    }

    /**
     * @param Category $categoryEntity
     * @return \App\Project
     */
    private function createProjectDbModelByServiceEntity(Project $projectEntity) {
        $outcome = null;
        if ($projectEntity != null) {
            if ($projectEntity->id > 0) {
                /** @var \App\Project $outcome */
                $outcome = $this->projectsRepository->find($projectEntity->id);
            } else {
                /** @var \App\Project $outcome */
                $outcome = new \App\Project();
            }

            if ($outcome != null) {
                $outcome->category_id = $projectEntity->category->id;
                $outcome->title = $projectEntity->title;
                $outcome->slug = $this->slugHelper->slugifyText($projectEntity->title);
                $outcome->show = $projectEntity->isVisible;

                foreach ($projectEntity->descriptionTranslations as $titleTranslation) {
                    $outcome->setTranslation('description', $titleTranslation->locale, $titleTranslation->value);
                }
            }
        }
        return $outcome;
    }

    /**
     * @return \App\CarouselImage
     */
    private function createHomeSlidesModel() {
        return new \App\CarouselImage();
    }

    /**
     * @param \Intervention\Image\Image $image
     * @return \Intervention\Image\Image
     */
    private function resizeImageIfRequired($image) {
        $maxImageSize = config('custom.images.upload.maxImagSize');
        if($maxImageSize != null && $maxImageSize > 0) {
            $imageWidth = $image->width();
            $imageHeight = $image->height();

            $newWidth = $maxImageSize;
            $newHeight = $maxImageSize;
            if($imageWidth >= $imageHeight) {
                $newHeight = null;
            }
            else {
                $newWidth = null;
            }
            // prevent possible upsizing
            $image->resize($newWidth, $newHeight, function ($constraint) {
                $constraint->aspectRatio();
                $constraint->upsize();
            });

        }
        return $image;
    }

    private function createPathIfNotExists($pathToBeCreated) {
        File::isDirectory($pathToBeCreated) or File::makeDirectory($pathToBeCreated, 0777, true, true);
    }

    private function getRealFilePathFromName(string $diskPath, $fileName) {
        return $diskPath . "/" . $fileName;
    }


    /**
     * @param \App\Image $dbResource
     * @param string $fileName
     * @return \App\External\ApiServiceEntities\Image|null
     */
    private function createImageEntityByDbModel(\App\Image $dbResource) {
        $outcome = null;
        if($dbResource != null) {
            $outcome = new \App\External\ApiServiceEntities\Image();
            $outcome->id = $dbResource->id;
            $outcome->name = $dbResource->name;
            $outcome->width = $dbResource->width;
            $outcome->height = $dbResource->height;
            $outcome->url = config('custom.images.uploadedImagesUrl') . "/" . $dbResource->name;
        }

        return $outcome;
    }

    /**
     * @param \App\Video $dbVideo
     * @param string $fileName
     * @return \App\External\ApiServiceEntities\Video|null
     */
    private function createVideoEntityByDbModel(\App\Video $dbVideo) {
        $outcome = null;
        if($dbVideo != null) {
            $outcome = new \App\External\ApiServiceEntities\Video();
            $outcome->id = $dbVideo->id;
            $outcome->name = $dbVideo->name;
            $outcome->url = $dbVideo->link;
        }
        return $outcome;
    }

    /**
     * @param \Intervention\Image\Image $image
     * @param string $fileName
     * @return \App\Image|null
     */
    private function createImageDbEntity(\Intervention\Image\Image $image, string $fileName) {
        $outcome = null;
        if ($fileName != null && !empty($fileName)) {
            /** @var \App\Image $outcome */
            $outcome = new \App\Image();

            if ($outcome != null) {
                $outcome->name = $fileName;
                $outcome->size = $image->fileSize();
                $outcome->width = $image->width();
                $outcome->height = $image->height();
            }
        }
        return $outcome;
    }

    /**
     * @param \App\Video $image
     * @param VideoEntity $videoEntity
     */
    private function createVideoDbModel(VideoEntity $videoEntity) {
        $outcome = null;
        if ($videoEntity != null) {
            $outcome = new \App\Video();

            if ($outcome != null) {
                $outcome->name = $videoEntity->name;
                $outcome->link = $videoEntity->url;
            }
        }
        return $outcome;
    }
}

