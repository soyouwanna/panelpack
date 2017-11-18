<?php
return[
    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => Decoweb\Panelpack\Models\User::class,
        ],

        'customers' => [
            'driver' => 'eloquent',
            'model' => Decoweb\Panelpack\Models\Customer::class,
        ],

    ],
];