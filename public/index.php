<?php

require '../vendor/autoload.php';

use Slim\Slim as Slim;

session_start();

$app = new Slim([
	'debug' => true,
	'templates.path' => '../app/views'
]);

require '../app/routes.php';

$app->run();
