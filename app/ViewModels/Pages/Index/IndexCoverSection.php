<?php

namespace App\ViewModels\Pages\Index;

class IndexCoverSection {

    /**
     * @var IndexImageViewModel
     */
    public $logo;

    /**
     * @var string
     */
    public $subtitle;

     /**
     * @var IndexCoverButton
     */
    public $button;

    public function __construct() {
        $this->logo = new IndexImageViewModel();
        $this->button = new IndexCoverButton();
    }

}
