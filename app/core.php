<?php

require '../vendor/autoload.php';

use Slim\Slim as Slim;
use Slim\Mustache\Mustache as Mustache;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

$data = require '../app/config.php';

// ==================================================================
//
// Init database
//
// ------------------------------------------------------------------

$capsule = new Capsule;

$capsule->addConnection($data['database']['default']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// ==================================================================
//
// Init Slim
//
// ------------------------------------------------------------------

$app = new Slim([
    'debug' => true,
    'templates.path' => '../app/views',
    'view' => new Mustache()
]);

// ==================================================================
//
// Login admin routes
//
// ------------------------------------------------------------------

require '../app/routes/admin.php';

// ==================================================================
//
//  Site routes
//
// ------------------------------------------------------------------

foreach ($data['langs'] as $lang) {

    $route = ($lang==$data['default_lang']) ? '' : '/'.$lang;

    $data['lang'] = $lang;

    $data['langs'] = require '../app/langs/'.$lang.'.php';

    $app->group($route, function () use ($app, $data) {

        require '../app/routes/site.php';

    });
}

// ==================================================================
//
//  Errors: 404
//
// ------------------------------------------------------------------

$app->notFound(function () use ($app, $data) {
    $data['langs']['metas']['title'] = '404 Page not Found';
    $app->render('404', $data);
});

// ==================================================================
//
//  Run App
//
// ------------------------------------------------------------------

$app->run();
