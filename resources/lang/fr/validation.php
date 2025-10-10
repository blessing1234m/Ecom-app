<?php

return [
    'required' => 'Le champ :attribute est obligatoire.',
    'max' => [
        'string' => 'Le champ :attribute ne doit pas dépasser :max caractères.',
        'file' => 'Le champ :attribute ne doit pas dépasser :max kilo-octets.',
    ],
    'image' => 'Le fichier :attribute doit être une image.',
    'mimes' => 'Le fichier :attribute doit être un fichier de type : :values.',
    // Personnalisation pour les champs spécifiques
    'custom' => [
        'title' => [
            'required' => 'Le titre est obligatoire.',
        ],
        'image' => [
            'max' => 'Le champ image ne doit pas dépasser :max kilo-octets.',
        ],
    ],
    'attributes' => [
        'title' => 'titre',
        'image' => 'image',
    ],
];
