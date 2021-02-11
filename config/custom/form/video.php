<?php

return [
    'id' => 'video_form',
    'withCaptcha' => false,
    'fields' => [
        'name' => [
            'type' => 1,
            'name' => 'name',
            'textKey' => 'validation.attributes.name',
            'errorTextKey' => '{"id": "validation-js.min.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ],

        'url' => [
            'type' => 1,
            'name' => 'url',
            'textKey' => 'validation.attributes.url',
            'errorTextKey' => '{"id": "validation-js.string", "params": {"min": 3}}',
            'validations' => ['required', 'min:3'],
        ]
    ]
];
