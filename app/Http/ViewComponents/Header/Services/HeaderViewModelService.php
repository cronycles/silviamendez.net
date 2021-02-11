<?php

namespace App\Http\ViewComponents\Header\Services;

use App\Http\ViewComponents\Header\Models\HeaderLogoViewModel;
use App\Http\ViewComponents\Header\Models\HeaderSocialLinkViewModel;
use App\Services\AuthService;
use App\Custom\Languages\Services\LanguageService;
use App\Custom\Pages\Services\PagesService;
use App\Http\ViewComponents\Header\Models\HeaderLinkViewModel;
use App\Http\ViewComponents\Header\Models\HeaderViewModel;
use Illuminate\Support\Facades\Route;

class HeaderViewModelService {

    /**
     * @var LanguageService
     */
    private $languageService;

    /**
     * @var PagesService
     */
    private $pagesService;

    /**
     * @var AuthService
     */
    private $authService;

    function __construct(
        PagesService $pagesService,
        LanguageService $languageService,
        AuthService $authService) {

        $this->pagesService = $pagesService;
        $this->languageService = $languageService;
        $this->authService = $authService;
    }

    public function getModel() {
        $outcome = new HeaderViewModel();
        $outcome->logo = $this->createLogoViewModel();
        $outcome->pageLinks = $this->createPageLinks();
        $outcome->socialLinks = $this->createSocialLinks();
        $outcome->userPageLinks = $this->createUserPageLinks();
        $outcome = $this->createViewModelLanguagesPart($outcome);
        $outcome = $this->createViewModelAdminPart($outcome);

        return $outcome;
    }

    /**
     * @return HeaderLogoViewModel
     */
    private function createLogoViewModel() {
        $outcome = new HeaderLogoViewModel();
        
        $outcome->imageUrl = config('custom.images.static.logoWhite');
        $outcome->url = route('index');
        $outcome->linkText = config('custom.company.name');
        $outcome->htmlTitle = $this->getMenuPageHtmlTitleFromConfig(config('custom.pages.INDEX'));
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createPageLinks() {
        $outcome = [
            $this->createProjectsLinkModel(),
            $this->createContactLinkModel()
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createSocialLinks() {
        $outcome = [
            new HeaderSocialLinkViewModel(
                config('custom.company.socials.linkedin.linkUrl'),
                config('custom.company.socials.linkedin.linkText'),
                config('custom.company.socials.linkedin.iconClass')),
            new HeaderSocialLinkViewModel(
                config('custom.company.socials.twitter.linkUrl'),
                config('custom.company.socials.twitter.linkText'),
                config('custom.company.socials.twitter.iconClass'))
        ];
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel[]
     */
    private function createUserPageLinks() {
        $outcome = [
            $this->createLoginLinkModel()
        ];
        return $outcome;
    }

    /**
     * @param HeaderViewModel $outcome
     * @return mixed
     */
    private function createViewModelLanguagesPart($outcome) {
        $visibleLanguages = $this->languageService->getVisibleLanguages();
        if (count($visibleLanguages) > 1) {
            foreach ($visibleLanguages as $visibleLanguage) {
                if ($visibleLanguage->isCurrent) {
                    $outcome->currentLanguage = $visibleLanguage->code;
                } else {
                    $url = route('lang.switch', $visibleLanguage->code);
                    $linkViewModel = new HeaderLinkViewModel($url, $visibleLanguage->code);
                    array_push($outcome->languageLinks, $linkViewModel);
                }
            }
        }

        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createProjectsLinkModel() {
        $url = "#projects";
        $text = __("page-index.projectsLinkText");
        $isActive = true;
        $outcome = new HeaderLinkViewModel($url, $text, $isActive);
        $outcome->htmlTitle = __("page-index.projectsLinkText");
        return $outcome;
    }

    /**
     * @return HeaderLinkViewModel
     */
    private function createContactLinkModel() {
        $url = "#contact";
        $text = __("page-index.contact-section-title");
        $isActive = true;
        $outcome = new HeaderLinkViewModel($url, $text, $isActive);
        $outcome->htmlTitle = __("page-index.contact-section-title");
        return $outcome;
    }

    /**
     * @param HeaderViewModel $vieModel
     * @return HeaderViewModel
     */
    private function createViewModelAdminPart($vieModel) {
        $vieModel->isUserAuth = $this->authService->isAnyUserAuthenticated();
        if ($vieModel->isUserAuth) {
            $userEntity = $this->authService->getAuthUser();
            $vieModel->userName = '@' . $userEntity->name;
        }
        $vieModel->adminPageLinks = [
            $this->createAuthHomeLink(),
            $this->createAuthHomeSlideLink(),
            $this->createAuthCategoriesLink(),
            $this->createAuthProjectsLink()
        ];
        return $vieModel;

    }

    private function createLoginLinkModel() {
        $url = route('login');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_LOGIN'));
        $isActive = Route::currentRouteNamed('login*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeLink() {
        $url = route('auth');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_INDEX'));
        $isActive = Route::currentRouteNamed('auth');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthHomeSlideLink() {
        $url = route('auth.home-slides');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_HOME_SLIDES'));
        $isActive = Route::currentRouteNamed('auth.home-slid*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthCategoriesLink() {
        $url = route('auth.categories');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_CATEGORIES'));
        $isActive = Route::currentRouteNamed('auth.categor*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function createAuthProjectsLink() {
        $userEntity = $this->authService->getAuthUser();
        $url = route('auth.projects');
        $text = $this->getMenuPageTextFromConfig(config('custom.pages.AUTH_PROJECTS'));
        $isActive = Route::currentRouteNamed('auth.project*');
        return new HeaderLinkViewModel($url, $text, $isActive);
    }

    private function getMenuPageTextFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->shortName;
        return $outcome;
    }

    private function getMenuPageHtmlTitleFromConfig(int $pageId) {
        $pageEntity = $this->pagesService->getPageById($pageId);
        $outcome = $pageEntity->htmlTitle;
        return $outcome;
    }

}
