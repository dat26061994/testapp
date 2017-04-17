<?php

Route::get('/', 'WelcomeController@index');

Route::get('admin', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);

Route::get('test',function(){
	echo "abc";
});
