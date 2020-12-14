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
        'types' => ['sepa_debit','sofort','card'],
    ],
];
