<?php

$data = [
	'metas' => [
		'title' => 'Site Title',
		'description' => 'Site description',
		'keywords' => 'Site keywords',
	],
	'css' => scandir('static/build/css', 1)[0],
	'js' => scandir('static/build/js', 1)[0]
];

$app->get('/', function () use ($app, $data){

	// $testDb = App\Models\Test::all();

	$app->render('home.php', $data);

});

// ERROR 404
$app->notFound(function () use ($app, $data){

	$app->render('404.php', $data);

});
