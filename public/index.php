<?php

require '../vendor/autoload.php';

use Slim\Slim as Slim;
use Slim\Mustache\Mustache as Mustache;

session_start();

$app = new Slim([
	'debug' => true,
	'templates.path' => '../app/views',
	'view' => new Mustache()
]);

require '../app/routes.php';

$app->run();
