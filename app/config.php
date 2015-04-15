<?php

use Illuminate\Database\Capsule\Manager as Capsule;

$capsule = new Capsule;

$capsule->addConnection(array(
	'driver' => 'mysql',
	'host' => 'localhost',
	'database' => '',
	'username' => '',
	'password' => '',
	'charset' => 'utf8',
	'collation' => 'utf8_general_ci',
	'prefix' => ''
));

$capsule->setAsGlobal();
$capsule->bootEloquent();
