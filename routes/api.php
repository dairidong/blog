<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::namespace('Api')->group(function ($router) {
    // 分类
    $router->get('/categories', 'CategoryController@index');
    $router->get('/categories/{category}', 'CategoryController@show');

    // 文章
    $router->get('/posts', 'PostController@index');
    $router->get('/posts/{post}', 'PostController@show');

    $router->get('/settings', 'SettingController@index');
});
