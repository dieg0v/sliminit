<?php

return [

    'siteurl' => 'http://localhost:8889',

    'author' => 'Author name',

    'sitename' => 'Site Name',

    'app_langs' => ['es','en','gl'],

    'default_lang' => 'es',

    'admin' => [
        'user' => 'admin',
        'pass' => '12345'
    ],

    'css' => scandir('static/build/css', 1)[0],

    'js' => scandir('static/build/js', 1)[0],

    'analytics' => false, // false or google analytics code as string 'UA-XXXXXXX-X'

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
        'days' => '15',
        'domain' => 'www.localhost.org',
    ]
];
