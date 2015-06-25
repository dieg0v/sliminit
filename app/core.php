<?php

require '../vendor/autoload.php';

use Slim\Slim as Slim;
use Slim\Mustache\Mustache as Mustache;
use Illuminate\Database\Capsule\Manager as Capsule;

session_start();

$local_conf = '../app/config/app.local.php';

if(file_exists($local_conf)){
    $data = require $local_conf;
}else{
    $data = require '../app/config/app.php';
}

// ==================================================================
//
// Init database
//
// ------------------------------------------------------------------

$capsule = new Capsule;

$capsule->addConnection($data['database']['default']);

$capsule->setAsGlobal();
$capsule->bootEloquent();

// ==================================================================
//
// Init Slim
//
// ------------------------------------------------------------------

$app = new Slim([
    'debug' => true,
    'templates.path' => '../app/views',
    'view' => new Mustache()
]);

// ==================================================================
//
// Login admin routes
//
// ------------------------------------------------------------------

require '../app/routes/admin.php';

// ==================================================================
//
//  Site routes
//
// ------------------------------------------------------------------

$lang_uri = explode("/", parse_url(
    $app->request->getResourceUri(), PHP_URL_PATH)
)[1];

$data['lang'] = $data['default_lang'];
$route = '';
$home_link = '/';

if(in_array($lang_uri, $data['app_langs'])){
    if($lang_uri!=$data['default_lang']){
        $data['lang'] = $lang_uri;
        $route = '/'.$lang_uri;
        $home_link = $route;
    }
}

$data['home_link'] = $home_link;

$data['langs'] = require '../app/langs/'.$data['lang'].'.php';

$pages = require '../app/config/pages.php';

$app->group($route, function () use ($app, $data, $pages) {

    require '../app/routes/site.php';

});

// ==================================================================
//
//  Errors 404 and 500
//
// ------------------------------------------------------------------

$app->notFound(function () use ($app) {
    $data['metas']['title'] = '404 Page not Found';
    $app->render('404', $data);
});

$app->error(function () use ($app) {
    $data['metas']['title'] = 'Internal server error';
    $app->render('500', $data);
});

// ==================================================================
//
//  Add before.dispatch and run app
//
// ------------------------------------------------------------------

$app->hook('slim.before.dispatch', function() use ($app, $data, $pages) {

    $routeName = $app->router()->getCurrentRoute()->getName();

    if(isset($data['langs']['metas'][$routeName])){
        $data['metas']['title'] = $data['langs']['metas'][$routeName]['title'];
        $data['metas']['description'] = $data['langs']['metas'][$routeName]['description'];
        $data['metas']['keywords'] = $data['langs']['metas'][$routeName]['keywords'];
    }

    $menu_langs = [];

    if($routeName){

        foreach ($data['app_langs'] as $lang) {
            $routeItem = new stdClass();
            $routeItem->lang = $lang;
            $routeItem->route = '/'.$lang;
            if(isset($pages[$routeName])){
                if($lang == $data['default_lang']){
                    $routeItem->route = '';
                    if($pages[$routeName][$lang]['route']=='/'){
                        $routeItem->route = '/';
                    }
                }
                if($pages[$routeName][$lang]['route']!='/'){
                    $routeItem->route .= $pages[$routeName][$lang]['route'];
                }
            }
            $menu_langs[] = $routeItem;
            $routeItem = null;
        }
    }

    $data['menu_langs'] = $menu_langs;

    $app->view->appendData($data);

});

$data['menu'] = [];

foreach ($data['langs']['menu'] as $key => $value) {
    $menuItem = new stdClass();
    $menuItem->lang = $value;
    $menuItem->route = $app->urlFor($key);
    if(strlen($menuItem->route)>1){
        if(substr($menuItem->route, -1)=='/'){
            $menuItem->route = substr($menuItem->route, 0, -1);
        }
    }
    $data['menu'][] = $menuItem;
    $menuItem = null;
}

$app->view->appendData($data);

$app->run();
