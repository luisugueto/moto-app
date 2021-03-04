<?php

Route::get('/', function () {
    return view('index');
});

Route::auth();

Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::resource('purchase_valuation', 'PurchaseValuationController');
    Route::resource('purchase_management', 'PurchaseManagementController');
    Route::resource('users', 'UserController');
    Route::get('profile/{id}', 'UserController@profile')->name('profile');
    Route::post('update_profile', 'UserController@update_profile')->name('update_profile');
    Route::get('change-password/{id}', 'UserController@change_password')->name('change-password');
    Route::post('update_password', 'UserController@update_password')->name('update_password');
});

Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });