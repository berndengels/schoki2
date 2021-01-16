<?php
return [
    'defaultEventTime'  => env('DEFAULT_EVENT_TIME', '19:00'),
    'maxImageHeight'    => env('MAX_IMAGE_HEIGHT', 300),
    'maxImageWidth'     => env('MAX_IMAGE_WIDTH', 533),
    'maxImageFileSize'  => env('MAX_IMAGE_FILESIZE', 3), // MB
    'paginationLimit' 	=> 10,
    'eventsPaginationLimit'	=> 30,
    'periodicPositions'  => [
        '1'           => 'jede Woche',
        '2'           => 'jeden zweiten',
        '3'           => 'jeden dritten',
        '4'           => 'jeden vierten',
        'first'     => 'monatlich jeden ersten',
        'second'    => 'monatlich jeden zweiten',
        'third'     => 'monatlich jeden dritten',
        'last'      => 'monatlich jeden letzten',
    ],
    'periodicWeekdays'   => [
        'monday'        => 'Montag',
        'tuesday'       => 'Dienstag',
        'wednesday'     => 'Mittwoch',
        'thursday'      => 'Donnerstag',
        'friday'        => 'Freitag',
        'saturday'      => 'Samstag',
        'sunday'        => 'Sonntag',
    ],
    'payment'   => [
        'tax'       => env('PAYMENT_TAX_RATE', 19),
        'types' => ['card','sofort','giropay'],

        'stripe' => env('STRIPE_ENABLED'),
        'paypal' => env('PAYPAL_ENABLED'),
    ],
    'vendor'    => [
        'name'      => 'Schokoladen Berlin-Mitte',
        'email'     => 'shop@schokoladen-mitte.de',
        'phone'     => '030 - 282 65 27',
        'street'    => 'Ackerstraße 169',
        'postcode'  => '10115',
        'city'      => 'Berlin',
        'url'       => env('APP_URL'),
    ],
    'shop' => [
        'email' => [
            'from'  => env('SHOP_EMAIL_FROM', 'shop@schokoladen-mitte.de')
        ],
    ],
];
