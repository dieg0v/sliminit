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
