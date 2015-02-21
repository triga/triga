<?php

Route::group(['middleware' => 'auth'], function () {
	Route::get('/', ['as' => 'dashboard', 'uses' => 'DashboardController@index']);
});

Route::get('home', 'HomeController@index');

Route::controllers([
	'auth' => 'Auth\AuthController',
	'password' => 'Auth\PasswordController',
]);
