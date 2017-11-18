<?php
return[
    'guards' => [
        'customer' => [
            'driver' => 'session',
            'provider' => 'customers',
        ],
    ],
];