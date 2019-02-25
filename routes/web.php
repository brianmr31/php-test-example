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

$router->get('api/v1/', function () use ($router) {
    return array("frantinco"=>"news");
});

$router->get('/api/v1/getnews', 'NewsController@listNewsInternet');
$router->get('/api/v1/getnews/{alias}', 'NewsController@getNewsInternet');

$router->group(['middleware' => 'auth:api'], function() use ($router) {
  $router->get('/api/v1/news', 'NewsController@listNews');
  $router->get('/api/v1/news/{id}', 'NewsController@getNews');
  $router->post('/api/v1/news', 'NewsController@addNews');
  $router->get('/api/v1/news/del/{id}', 'NewsController@delNews');
  $router->post('/api/v1/news/put/{id}', 'NewsController@putNews');
});
