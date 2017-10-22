<?php
return[
    'disks' => [

        'invoices' => [
            'driver' => 'local',
            'root' => storage_path('app/invoices'),
            'visibility' => 'public',
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
            'visibility' => 'public',
        ],

    ],
];