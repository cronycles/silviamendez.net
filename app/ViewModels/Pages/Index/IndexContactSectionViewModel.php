<?php

namespace App\ViewModels\Pages\Index;

use App\Custom\Form\Models\FormModel;

class IndexContactSectionViewModel {

    /**
     * @var string
     */
    public $title;

    /**
     * @var string
     */
    public $address;

    /**
     * @var string
     */
    public $email;

    /**
     * @var string
     */
    public $phone;

    /**
     * @var string
     */
    public $formTitleText;

    /**
     * @var FormModel
     */
    public $formData;

    public function __construct() {
    }

}
