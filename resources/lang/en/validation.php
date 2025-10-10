<?php

return [
    'required' => 'The :attribute field is required.',
    'max' => [
        'string' => 'The :attribute field must not be greater than :max characters.',
        'file' => 'The :attribute field must not be greater than :max kilobytes.',
    ],
    'image' => 'The :attribute must be an image.',
    'mimes' => 'The :attribute must be a file of type: :values.',
    'custom' => [
        'image' => [
            'max' => 'The image field must not be greater than :max kilobytes.',
        ],
    ],
    'attributes' => [
        'image' => 'image',
    ],
];
