<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
/** @var \Illuminate\Routing\Router $router */
$router->post('/register', 'API\AuthController@register');
$router->post('/login', 'API\AuthController@login');
$router->post('/cinema', 'API\CinemaController@add');
$router->get('/cinema', 'API\CinemaController@index');
$router->post('/update', 'API\CinemaController@update');
$router->post('/cinema/${id}', 'API\CinemaController@delete');

