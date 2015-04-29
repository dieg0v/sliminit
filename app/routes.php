<?php

$data = [
	'metas' => [
		'title' => 'Site Title',
		'description' => 'Site description',
		'keywords' => 'Site keywords',
	],
	'css' => scandir('static/build/css', 1)[0],
	'js' => scandir('static/build/js', 1)[0],
	'analytics' => false // false or google analytics code as string 'UA-XXXXXXX-X'
];


$app->get('/', function () use ($app, $data){

	// $testDb = App\Models\Test::all();

	$app->render('home.mustache', $data);

});

// ERROR 404
$app->notFound(function () use ($app, $data){

	$data['metas']['title'] = '404 Page not Found';

	$app->render('404.mustache', $data);

});
