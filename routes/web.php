<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$router->get('/', function () use ($router) {
    return $router->app->version();
});

$router->get('/user/login', 'LoginController@login');
$router->post('/user/login', 'LoginController@login');

$router->get('/user/info', 'LoginController@userInfo');
$router->post('/api/admin/login/sso/user/jwttoken', 'LoginController@jwttoken');
// $router->get('/api/admin/login/sso/user/jwttoken', 'LoginController@jwttoken');

$router->get('/resources/index', 'ResourcesController@fetchResources');
$router->get('/resources/sound/{id}', 'ResourcesController@fetchResourcesSound');
$router->post('/resources/add', 'ResourcesController@createResources');
$router->post('/resources/edit', 'ResourcesController@updateResources');

$router->post('/resources/qrcode', 'ResourcesController@createResourcesQrcode');

$router->post('/resources/upload', 'ResourcesController@upload');
