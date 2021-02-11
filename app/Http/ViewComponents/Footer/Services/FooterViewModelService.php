<?php

namespace App\Http\ViewComponents\Footer\Services;

use App\Http\ViewComponents\Footer\Models\SubFooterViewModel;
use App\Http\ViewComponents\Footer\Models\FooterSocialLinkViewModel;
use App\Http\ViewComponents\Footer\Models\FooterViewModel;

class FooterViewModelService {

    public function __construct() {
    }

    public function getModel() {
        $outcome = new FooterViewModel();

        $outcome->socials = $this->createSocialLinks();
        $outcome->sub = $this->createSubFooterViewModel();

        return $outcome;
    }

    /**
     * @return FooterSocialLinkViewModel[]
     */
    private function createSocialLinks() {
        $outcome = [
            new FooterSocialLinkViewModel(
                config('custom.company.socials.linkedin.linkUrl'),
                config('custom.company.socials.linkedin.linkText'),
                config('custom.company.socials.linkedin.iconClass')),
            new FooterSocialLinkViewModel(
                config('custom.company.socials.twitter.linkUrl'),
                config('custom.company.socials.twitter.linkText'),
                config('custom.company.socials.twitter.iconClass'))
        ];
        return $outcome;
    }

    /**
     * @return SubFooterViewModel
     */
    private function createSubFooterViewModel() {
        $outcome = new SubFooterViewModel();
        $outcome->cookiePolicyText = __('footer.cookie-policy-text');
        $outcome->cookiePolicyUrl = route('cookie');
        $outcome->privacyPolicyText = __('footer.privacy-policy-text');
        $outcome->privacyPolicyUrl = route('privacy');
        $outcome->copyrightText = "Copiright © ". now()->year ." " .config('custom.company.crointhemorning.name');
        $outcome->copyrightUrl = config('custom.company.crointhemorning.url');
        $outcome->vatNumber = __('footer.copyright.vat-number') . " " .config('custom.company.vat-number');
        $outcome->allRightReserved = __('footer.rights-reserved');
        $outcome->appVersion = "v" . config('app.version');

        return $outcome;

    }

}
