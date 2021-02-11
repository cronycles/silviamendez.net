<?php

$uploadedImagesPath = config('custom.cdnsite.path') . '/upload/images';
$uploadedImagesUrl = config('custom.cdnsite.url') . '/upload/images';

$uploadedHomeSlidesPath = config('custom.cdnsite.path') . '/upload/home-slides';
$uploadedHomeSlidesUrl = config('custom.cdnsite.url') . '/upload/home-slides';
$imagesBaseUrl = config('custom.cdnsite.url') . '/images';

return [
    'uploadedImagePath' => $uploadedImagesPath,
    'uploadedImagesUrl' => $uploadedImagesUrl,
    'uploadedHomeSlidesPath' => $uploadedHomeSlidesPath,
    'uploadedHomeSlidesUrl' => $uploadedHomeSlidesUrl,

    'imagesBaseUrl' => $imagesBaseUrl,
    'partnersUrl' => $imagesBaseUrl . '/partners',

    'upload' => [
        'maxNumberOfFiles' => 50,
        'maxImagSize' => 1500
    ],

    'static' => [
        'defaultLazyPlaceholder' => $imagesBaseUrl . '/lazy-img-placeholder.png',
        'logoWhite' => $imagesBaseUrl . '/logo-white_v3.0.png',
        'aboutPhoto' => $imagesBaseUrl . '/about_v1.0.jpg',
        'socialsDefaultLogo' => $imagesBaseUrl . '/og_social_default_logo.jpg',
        'shopWindow' => $imagesBaseUrl . '/shop-ext-contact.jpg',
        'defaultProjectImage' => $imagesBaseUrl . '/defaultProjectImage_560x360.jpg'
    ]
];
