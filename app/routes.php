<?php

$data = [
	'metas' => [
		'title' => 'Site Title',
		'description' => 'Site description',
		'keywords' => 'Site keywords',
	],
	'admin' => [
		'user' => 'admin',
		'pass' => '12345'
	],
	'css' => scandir('static/build/css', 1)[0],
	'js' => scandir('static/build/js', 1)[0],
	'analytics' => false // false or google analytics code as string 'UA-XXXXXXX-X'
];


// ==================================================================
//
//  Site routes
//
// ------------------------------------------------------------------

$app->get('/', function () use ($app, $data){
	// $testDb = App\Models\Test::all();
	$app->render('home.mustache', $data);

});


// ==================================================================
//
//  Errors: 404
//
// ------------------------------------------------------------------

$app->notFound(function () use ($app, $data){
	$data['metas']['title'] = '404 Page not Found';
	$app->render('404.mustache', $data);
});


// ==================================================================
//
// Login admin routes
//
// ------------------------------------------------------------------


$app->get('/login', function () use ($app, $data) {
	$data['metas']['title'] = 'Admin';
	$app->render('login.mustache', $data);
});

$app->post('/login', function () use ($app, $data) {

	$login_usr = trim($app->request()->post('login_usr'));
	$login_pass = trim($app->request()->post('login_pass'));

	if($data['admin']['user']==$login_usr && $data['admin']['pass']==$login_pass){
		$_SESSION['user'] = $login_usr;
		header("Location: /admin");
		exit;
	}

	header("Location: /logout");
	exit;	
});


$app->get('/admin', function () use ($app, $data) {

	if(!isset($_SESSION['user'])){
		header("Location: /logout");
		exit;
	}
	
	$data['metas']['title'] = 'Admin';
	$app->render('admin.mustache', $data);

});

$app->get('/logout', function (){

	$_SESSION['user'] = null;
	unset($_SESSION['user']);
	session_destroy();

	header("Location: /login");
	exit;

});



