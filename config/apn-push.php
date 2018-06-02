<?php

return [
    'default_apn' => 'default',

    'apns' => [
        'default' => [
            'bundle_id' => env('APN_BUNDLE_ID', ''),
            'sandbox'       => env('APN_SANDBOX', false),

            'authenticator' => [
                // For use JWT authenticator
                'jwt' => [
                    'teamId'          => env('APN_TEAM_ID', ''),
                    'key'             => env('APN_KEY', ''),
                    'certificatePath' => env('APN_CERTIFICATE_PATH', ''),
                ],

                // For use Certificate authenticator
                //'certificate' => [
                //    'path'       => env('APN_CERTIFICATE_PATH', ''),
                //    'passphrase' => env('APN_CERTIFICATE_PASSPHRASE', ''),
                //],
            ],
        ],
    ],
];
