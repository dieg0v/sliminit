<?php

// ==================================================================
//
// Atomatic page resolution based on page config file
//
// ------------------------------------------------------------------

foreach ($pages as $key => $page) {

    $app->get($page[$data['lang']]['route'], function () use ($app, $page, $data){

        $app->render($page[$data['lang']]['view']);

    })->name($key);
}

// ==================================================================
//
// Non auto, custom test page example
//
// ------------------------------------------------------------------

$app->get("/test", function () use ($app, $data){

    echo $app->router()->getCurrentRoute()->getName(). '-> this is a manual page test example on lang: '.$data['lang'];

})->name('test');
