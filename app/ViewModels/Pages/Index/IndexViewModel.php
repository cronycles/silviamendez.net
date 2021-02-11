<?php

namespace App\ViewModels\Pages\Index;

use App\ViewModels\Pages\PageViewModel;

class IndexViewModel extends PageViewModel {

    /**
     * @var IndexSlidesSectionViewModel
     */
    public $slidesSection;

    /**
     * @var IndexCoverSection
     */
    public $coverSection;

    /**
     * @var IndexPresentationSectionViewModel
     */
    public $presentationSection;

    /**
     * @var IndexProjectsSectionViewModel
     */
    public $projectsSection;

    /**
     * @var IndexContactSectionViewModel
     */
    public $contactSection;

    public function __construct() {
        parent::__construct();
    }

}
