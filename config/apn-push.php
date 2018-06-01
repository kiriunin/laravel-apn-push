<?php

return [
    /*
    |--------------------------------------------------------------------------
    | Laravel APN push
    |--------------------------------------------------------------------------
    */

    'default' => env('APN_CONNECTION', 'jwt'),

    'packageId' => env('APN_PACKAGE_ID', null),

    'sandbox' => env('APN_SANDBOX', false),

    'connections' => [
        'jwt' => [
            'teamId' => env('APN_TEAM_ID', ''),
            'key' => env('APN_KEY', ''),
            'certificatePath' => env('APN_CERTIFICATE', ''),
        ],
        'certificate' => [
            'certificatePath' => env('APN_CERTIFICATE', ''),
            'passphrase' => env('APN_CERTIFICATE', ''),
        ]
    ]
];