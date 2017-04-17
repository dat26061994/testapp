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

Route::get('/', 'WelcomeController@index');

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::group(['prefix'=>'admin'],function(){
	Route::group(['prefix'=>'cate'],function(){
		Route::get('list',['as'=>'admin.cate.getList','uses'=>'CateController@getList']);
		Route::get('add',['as'=>'admin.cate.getAdd','uses'=>'CateController@getAdd']);
		Route::post('add',['as'=>'admin.cate.postAdd','uses'=>'CateController@postAdd']);
		Route::get('edit',['as'=>'admin.cate.getEdit','uses'=>'CateController@getEdit']);
		Route::post('edit',['as'=>'admin.cate.postEdit','uses'=>'CateController@postEdit']);
		Route::get('delete',['as'=>'admin.cate.getDelete','uses'=>'CateController@getDelete']);
		Route::post('delete',['as'=>'admin.cate.postDelete','uses'=>'CateController@postDelete']);
	});
});
