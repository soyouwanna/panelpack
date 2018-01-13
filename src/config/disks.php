<?php
return[
    'invoices' => [
        'driver' => 'local',
        'root' => storage_path('app/invoices'),
    ],

    'uploads' => [
        'driver' => 'local',
        'root' => storage_path('app/uploads'),
    ],

    'og_image' => [
        'driver' => 'local',
        'root' => storage_path('app/og_image'),
    ],

    'www' => [
        'driver' => 'local',
        'root' => public_path(),
    ],
    'files' => [
        'driver' => 'local',
        'root' => public_path(),
    ],
    'files_p' => [
        'driver' => 'local',
        'root' => rtrim(__DIR__,'laravel/config').'/public_html/',
    ],
];