<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get(__('routes.index'), ['as' => 'index', 'uses' => 'PagesController@index']);


Route::post('contact', ['as' => 'contact.send', 'uses' => 'ContactController@send']);

Route::get(__('routes.cookie'), ['as' => 'cookie', 'uses' => 'PagesController@cookie']);
Route::get(__('routes.privacy'), ['as' => 'privacy', 'uses' => 'PagesController@privacy']);

//Login Routes...
Route::get('login', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('login', ['as' => 'login', 'uses' => 'Auth\LoginController@login']);
Route::post('logout', ['as' => 'logout', 'uses' => 'Auth\LoginController@logout']);

//Confirm Password Routes
Route::get('password/confirm', ['as' => 'password.confirm', 'uses' => 'Auth\ConfirmPasswordController@showConfirmForm']);
Route::post('password/confirm', ['as' => 'password.confirm', 'uses' => 'Auth\ConfirmPasswordController@confirm']);

//Forgot Password Routes...
Route::post('password/email', ['as' => 'password.email', 'uses' => 'Auth\ForgotPasswordController@sendResetLinkEmail']);
Route::get('password/reset', ['as' => 'password.request', 'uses' => 'Auth\ForgotPasswordController@showLinkRequestForm']);

Route::post('password/reset', ['as' => 'password.update', 'uses' => 'Auth\ResetPasswordController@reset']);
Route::get('password/reset/{token}', ['as' => 'password.reset', 'uses' => 'Auth\ResetPasswordController@showResetForm']);

//Registration Routes...
//Route::get('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@showRegistrationForm']);
//Route::post('register', ['as' => 'register', 'uses' => 'Auth\RegisterController@register']);

Route::get('lang/{language}', ['as' => 'lang.switch', 'uses' => 'LanguageController@switchLang']);

Route::group(['middleware' => 'auth'], function () {
    Route::get('/auth', ['as' => 'auth', 'uses' => 'Auth\AuthPagesController@index']);

    Route::get('auth/cache-flush', function () {
        Cache::flush();
        dd("cache flushed");
    });

    //Auth Slides
    Route::get('/auth/home-slides', ['as' => 'auth.home-slides', 'uses' => 'Auth\AuthPagesController@homeSlides']);

    Route::post('/auth/home-slides/images', ['as' => 'auth.home-slides.images.upload', 'uses' => 'Auth\HomeSlides\AuthHomeSlidesController@uploadImages']);
    Route::post('/auth/home-slides/images-sort', ['as' => 'auth.home-slides.imagesSort', 'uses' => 'Auth\HomeSlides\AuthHomeSlidesController@updateImagesSortNoEntity']);
    Route::post('/auth/home-slides/images/{imageId}/is-mobile', ['as' => 'auth.home-slides.images.isMobile', 'uses' => 'Auth\HomeSlides\AuthHomeSlidesController@changeIsMobilePropertyNoEntity']);
    Route::delete('/auth/home-slides/images/{imageId}', ['as' => 'auth.home-slides.images.delete', 'uses' => 'Auth\HomeSlides\AuthHomeSlidesController@deleteImageNoEntity']);

    //Auth Categories
    Route::get('/auth/categories', ['as' => 'auth.categories', 'uses' => 'Auth\AuthPagesController@categories']);
    Route::get('/auth/categories/create', ['as' => 'auth.categories.create', 'uses' => 'Auth\AuthPagesController@categoryCreate']);
    Route::get('/auth/categories/{id}/edit', ['as' => 'auth.categories.edit', 'uses' => 'Auth\AuthPagesController@categoryEdit']);
    Route::get('/auth/categories/sort', ['as' => 'auth.categories.sort', 'uses' => 'Auth\AuthPagesController@categoriesSort']);

    Route::post('/auth/categories/create', ['as' => 'auth.categories.create', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@store']);
    Route::post('/auth/categories/{id}/edit', ['as' => 'auth.categories.update', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@update']);
    Route::delete('/auth/categories/{id}', ['as' => 'auth.categories.delete', 'uses' => 'Auth\Categories\AuthCategoriesCrudController@delete']);

    Route::post('/auth/categories/sort', ['as' => 'auth.categories.sort', 'uses' => 'Auth\Categories\AuthCategoriesSortingController@updateSort']);


    //Auth Projects
    Route::get('/auth/projects', ['as' => 'auth.projects', 'uses' => 'Auth\AuthPagesController@projects']);
    Route::get('/auth/projects/create', ['as' => 'auth.projects.create', 'uses' => 'Auth\AuthPagesController@projectCreate']);
    Route::get('/auth/projects/{id}/edit', ['as' => 'auth.projects.edit', 'uses' => 'Auth\AuthPagesController@projectEdit']);
    Route::get('/auth/projects/sort', ['as' => 'auth.projects.sort', 'uses' => 'Auth\AuthPagesController@projectsSort']);
    Route::get('/auth/projects/{id}/resources-sort', ['as' => 'auth.projects.resourcesSort', 'uses' => 'Auth\AuthPagesController@projectResourcesSort']);
    Route::get('/auth/projects/{id}/images', ['as' => 'auth.projects.images', 'uses' => 'Auth\AuthPagesController@projectImages']);
    Route::get('/auth/projects/{id}/videos', ['as' => 'auth.projects.videos', 'uses' => 'Auth\AuthPagesController@projectVideos']);

    Route::post('/auth/projects/create', ['as' => 'auth.projects.create', 'uses' => 'Auth\Projects\AuthProjectsCrudController@store']);
    Route::post('/auth/projects/{id}/edit', ['as' => 'auth.projects.update', 'uses' => 'Auth\Projects\AuthProjectsCrudController@update']);
    Route::delete('/auth/projects/{id}', ['as' => 'auth.projects.delete', 'uses' => 'Auth\Projects\AuthProjectsCrudController@delete']);

    Route::post('/auth/projects/sort', ['as' => 'auth.projects.sort', 'uses' => 'Auth\Projects\AuthProjectsSortingController@updateSort']);
    
    Route::post('/auth/projects/{id}/resources-sort', ['as' => 'auth.projects.resourcesSort', 'uses' => 'Auth\Projects\AuthProjectsResourcesController@updateResourcesSort']);

    Route::post('/auth/projects/{id}/images', ['as' => 'auth.projects.images.upload', 'uses' => 'Auth\Projects\AuthProjectsImagesController@uploadImages']);
    Route::delete('/auth/projects/{id}/images/{imageId}', ['as' => 'auth.projects.images.delete', 'uses' => 'Auth\Projects\AuthProjectsImagesController@deleteImage']);

    Route::post('/auth/projects/{id}/videos', ['as' => 'auth.projects.videos.upload', 'uses' => 'Auth\Projects\AuthProjectsVideosController@uploadVideo']);
    Route::get('/auth/projects/{id}/videos/{videoId}', ['as' => 'auth.projects.videos.delete', 'uses' => 'Auth\Projects\AuthProjectsVideosController@deleteVideo']);

});

//404 route! Questa route deve sempre stare in fondo a tutto!
Route::get('/{any}', 'PagesController@unknown')->where('any', '.*');
