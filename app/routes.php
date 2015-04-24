<?php


$app->get('/', function () use ($app) {

	$data['css'] = scandir('static/build/css', 1)[0];
	$data['js'] = scandir('static/build/js', 1)[0];

	// $testDb = App\Models\Test::all();

	$app->render('home.php', $data);

});

// ERROR 404
$app->notFound(function () use ($app, $data) {

	$data['css'] = scandir('static/build/css', 1)[0];
	$data['js'] = scandir('static/build/js', 1)[0];

	$app->render('404.php', $data);
});

