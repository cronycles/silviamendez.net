<?php

namespace App\ViewModelPageBuilders;

use App\Custom\Pages\Builders\ViewModelPageBuilder;
use App\FormBuilders\ContactFormBuilder;
use App\Services\Carousel\CarouselImagesService;
use App\Services\ContactService;
use App\Services\Projects\ProjectsService;
use App\ViewModels\Pages\Index\IndexProjectsSectionViewModel;
use App\ViewModels\Pages\Index\IndexPresentationSectionViewModel;
use App\ViewModels\Pages\Index\IndexSlidesSectionViewModel;
use App\ViewModels\Pages\Index\IndexContactSectionViewModel;
use App\ViewModels\Pages\Index\IndexCoverSection;
use App\ViewModels\Pages\Index\IndexViewModel;
use App\ViewModels\Pages\Index\SlideViewModel;
use App\ViewModelsServices\ProjectsViewModelService;

class IndexViewModelPageBuilder extends ViewModelPageBuilder {

    /**
     * @var ProjectsService
     */
    private $projectsService;

    /**
     * @var ProjectsViewModelService
     */
    private $projectsViewModelService;

    /**
     * @var CarouselImagesService
     */
    private $carouselImagesService;

    /**
     * @var ContactService
     */
    private $contactService;

    /**
     * @var ContactFormBuilder
     */
    private $contactFormBuilder;


    public function __construct(
        ProjectsService $projectsService,
        CarouselImagesService $carouselImagesService,
        ProjectsViewModelService $projectsViewModelService,
        ContactService $contactService,
        ContactFormBuilder $contactFormBuilder) {

        $this->projectsService = $projectsService;
        $this->carouselImagesService = $carouselImagesService;
        $this->projectsViewModelService = $projectsViewModelService;
        $this->contactService = $contactService;
        $this->contactFormBuilder = $contactFormBuilder;
    }

    public function createNewViewModel() {
        return new IndexViewModel();
    }

    /**
     * @param IndexViewModel $pageViewModel
     * @param array $params
     * @return IndexViewModel
     */
    public function fillPageViewModel($pageViewModel, $params) {
        $pageViewModel->slidesSection = $this->fillSlidesSection();
        $pageViewModel->coverSection = $this->fillCoverSection();
        $pageViewModel->presentationSection = $this->fillPresentationSection();
        $pageViewModel->projectsSection = $this->fillProjectsSection();
        $pageViewModel->contactSection = $this->fillContactSection();

        return $pageViewModel;
    }

    /**
     * @return IndexSlidesSectionViewModel
     */
    private function fillSlidesSection() {
        $outcome = new IndexSlidesSectionViewModel();

        $carouselImagesEntities = $this->carouselImagesService->getCarouselImages();
        foreach ($carouselImagesEntities as $carouselImagesEntity) {
            $slide = new SlideViewModel();
            $slide->imageAltText = config('custom.company.name');
            $slide->imageUrl = $carouselImagesEntity->image->url;
            $slide->isMobileSlide = $carouselImagesEntity->isMobile;
            array_push($outcome->slides, $slide);
        }
        return $outcome;
    }

    /**
     * @return IndexCoverSection
     */
    private function fillCoverSection() {
        $outcome = new IndexCoverSection();

        $outcome->logo->url = config('custom.images.static.logoWhite');
        $outcome->logo->altText = config('custom.company.name');
        $outcome->subtitle = __('page-index.description');
        $outcome->button->url = '#projects';
        $outcome->button->text = __('page-index.projectsLinkText');

        return $outcome;
    }

    /**
     * @return IndexPresentationSectionViewModel
     */
    private function fillPresentationSection() {
        $outcome = new IndexPresentationSectionViewModel();

        $outcome->title = __('page-index.presentation-section-title');
        $outcome->text = __('page-index.presentation-section-text');
        $outcome->photo->url = config('custom.images.static.aboutPhoto');
        $outcome->photo->altText = config('custom.company.name');
        $outcome->downloadCvFileUrl = config('custom.cdnsite.url') . "/" . __('page-index.presentation-section-cv-filename');
        $outcome->downloadCvText = __('page-index.presentation-section-download-cv');

        return $outcome;
    }

    /**
     * @return IndexProjectsSectionViewModel
     */
    private function fillProjectsSection() {
        $outcome = new IndexProjectsSectionViewModel();

        $projectEntities = $this->projectsService->getProjects();

        $outcome->title = __('page-index.projects-section-title');
        $outcome->seeMoreText = __('page-index.projects-section-more');
        $outcome->seeMoreUrl = '#projects';

        $outcome->projects = $this->projectsViewModelService->createProjectsModel($projectEntities);

        return $outcome;
    }

    /**
     * @return IndexContactSectionViewModel
     */
    private function fillContactSection() {
        $outcome = new IndexContactSectionViewModel();

        $outcome->title = __('page-index.contact-section-title');
        $outcome->address = __('page-index.contact-section-address');
        $outcome->email = __('page-index.contact-section-email');
        $outcome->phone = __('page-index.contact-section-phone');
        $outcome->formTitleText = __('page-index.contact-section-formTitleText');
        $outcome->formSendText = __('page-index.contact-section-formSendText');
        
        $outcome->formData = $this->createFormViewModelData();

        
        return $outcome;
    }

    /**
     * @return FormModel
     */
    private function createFormViewModelData() {

        return $this->contactFormBuilder->createFormViewModelByConfigurationAndEntity(route('contact.send'), __('page-index.contact-section-formSendText'));

    }

}
