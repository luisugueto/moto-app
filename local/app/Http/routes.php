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
    Route::resource('user_types', 'UserTypesController');
    Route::get('profile/{id}', 'UserController@profile')->name('profile');
    Route::post('update_profile', 'UserController@updateProfile')->name('updateProfile');
    Route::post('update_password', 'UserController@updatePassword')->name('updatePassword');
    Route::resource('states', 'StatesController');
    Route::resource('emails', 'EmailsController');
    Route::post('change-status-state/{id}', 'StatesController@changeStatus')->name('changeStatusStates');

    Route::post('applyState', 'PurchaseValuationController@applyState');

    // AJAX
	Route::post('getModel', 'HomeController@getModel');
});

Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });