<?php

return [
     /*
    |--------------------------------------------------------------------------
    | User Module
    |--------------------------------------------------------------------------
    | User specific modules
    |
    */
    'user' => [
        'relations' => [],
        'social-providers' => ['facebook', 'google'],
        'setting-types' => ['string', 'boolean', 'integer', 'float'],
        'address-types' => ['home', 'work'],
        'genders' => ['male', 'female', 'other']
    ]

];