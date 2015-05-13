<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::pattern('id','[0-9]+');

Route::group(['prefix' => 'admin'], function(){
    Route::group(['prefix' => 'categories'], function(){
        Route::get('create', ['as'=> 'categoriesCreate','uses' => 'Admin\AdminCategoriesController@create']);
        Route::get('request/{id}', ['as'=> 'categoriesRequest','uses' => 'Admin\AdminCategoriesController@request']);
        Route::get('update/{id}', ['as'=> 'categoriesUpdate','uses' => 'Admin\AdminCategoriesController@update']);
        Route::get('delete/{id}', ['as'=> 'categoriesDelete','uses' => 'Admin\AdminCategoriesController@delete']);
        Route::get('/', ['as'=> 'categoriesList','uses' => 'Admin\AdminCategoriesController@index']);
    });

    Route::group(['prefix' => 'products'], function(){
        Route::get('create', ['as'=> 'productsCreate','uses' => 'Admin\AdminProductsController@create']);
        Route::get('request/{id}', ['as'=> 'productsRequest','uses' => 'Admin\AdminProductsController@request']);
        Route::get('update/{id}', ['as'=> 'productsUpdate','uses' => 'Admin\AdminProductsController@update']);
        Route::get('delete/{id}', ['as'=> 'productsDelete','uses' => 'Admin\AdminProductsController@delete']);
        Route::get('/', ['as'=> 'productsList','uses' => 'Admin\AdminProductsController@index']);
    });
});


Route::get('/', 'WelcomeController@index');

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);


