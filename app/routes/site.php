<?php

$app->get('/', function () use ($app, $data){

    // $testDb = App\Models\Test::all();
    $app->render('home', $data);

});

$app->get('/about-us', function () use ($app, $data){

    $app->render('about', $data);

});
