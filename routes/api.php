<?php
/** @var \Illuminate\Routing\Router $router */
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['api']], function () {
    Route::post('/register', [
        'uses' => 'Auth\AuthController@register',
    ]);

    Route::post('/login', [
        'uses' => 'Auth\AuthController@login',
    ]);

    Route::group(['middleware' => 'jwt.auth'], function () {
        Route::get('/user', [
            'uses' => 'UserController@index',
        ]);
    });

});

$router->group(['prefix' => 'user','namespace' => 'Api'], function() use($router){
    $router->get('/','UserController@index');
    $router->get('/show/{id}','UserController@show');
    $router->post('/store','UserController@store');
    $router->put('/update/{id}','UserController@update');
    $router->delete('/destroy/{id}','UserController@destroy');

    $router->get('/posts','UserController@posts');
});

$router->group(['prefix' => 'post', 'namespace' => 'Api'], function() use($router){
    $router->get('/','PostController@index');
    $router->get('/show/{id}','PostController@show');
    $router->post('/store','PostController@store');
    $router->put('/update/{id}','PostController@put');
    $router->delete('/destroy/{id}','PostController@destroy');

    $router->get('/search','PostController@search');
});