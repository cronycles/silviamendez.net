<?php

namespace App\ViewModels\Pages\Index;

class IndexPresentationSectionViewModel {

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $text;

    /**
     * @var IndexImageViewModel
     */
    public $photo;

     /**
     * @var string
     */
    public $downloadCvText;

    /**
     * @var string
     */
    public $downloadCvFileUrl;

    public function __construct() {

        $this->photo = new IndexImageViewModel();
    }

}
