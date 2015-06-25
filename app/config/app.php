<?php

return [

    'app_langs' => ['es','en','gl'],

    'default_lang' => 'es',

    'admin' => [
        'user' => 'admin',
        'pass' => '12345'
    ],

    'css' => scandir('static/build/css', 1)[0],

    'js' => scandir('static/build/js', 1)[0],

    // analytics => false or google analytics code as string 'UA-XXXXXXX-X'
    'analytics' => false,

    'database' => [

        'default' => [

            'driver' => 'mysql',
            'host' => 'localhost',
            'database' => '',
            'username' => '',
            'password' => '',
            'charset' => 'utf8',
            'collation' => 'utf8_general_ci',
            'prefix' => ''

        ]
    ],

    'cookies' => [

        'active' => true,
        'name' => 'cookie_law',
        'time' => '3600',
        'domain' => 'www.localhost.org',
    ]
];
