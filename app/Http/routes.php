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
        Route::get('create', ['as'=> 'categoriesCreate','uses' => 'Admin\CategoriesController@create']);
        Route::post('store', ['as'=> 'categoriesStore','uses' => 'Admin\CategoriesController@store']);
        Route::get('edit/{id}', ['as'=> 'categoriesEdit','uses' => 'Admin\CategoriesController@edit']);
        Route::put('update/{id}', ['as'=> 'categoriesUpdate','uses' => 'Admin\CategoriesController@update']);
        Route::get('delete/{id}', ['as'=> 'categoriesDelete','uses' => 'Admin\CategoriesController@delete']);
        Route::get('/', ['as'=> 'categoriesList','uses' => 'Admin\CategoriesController@index']);
    });

    Route::group(['prefix' => 'products'], function(){
        Route::get('create', ['as'=> 'productsCreate','uses' => 'Admin\ProductsController@create']);
        Route::post('store', ['as'=> 'productsStore','uses' => 'Admin\ProductsController@store']);
        Route::get('edit/{id}', ['as'=> 'productsEdit','uses' => 'Admin\ProductsController@edit']);
        Route::put('update/{id}', ['as'=> 'productsUpdate','uses' => 'Admin\ProductsController@update']);
        Route::get('delete/{id}', ['as'=> 'productsDelete','uses' => 'Admin\ProductsController@delete']);
        Route::get('/', ['as'=> 'productsList','uses' => 'Admin\ProductsController@index']);
    });
});


Route::get('/', 'WelcomeController@index');

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);



