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
    Route::resource('roles', 'RoleController');
    Route::get('profile/{id}', 'UserController@profile')->name('profile');
    Route::post('update_profile', 'UserController@updateProfile')->name('updateProfile');
    Route::post('update_password', 'UserController@updatePassword')->name('updatePassword');
    Route::resource('states', 'StatesController');
    Route::resource('emails', 'EmailsController');
    Route::resource('processes', 'ProcessesController');

    Route::post('show-images', 'PurchaseValuationController@showImages');

    // Apply Functions in Purchase Valuation
    Route::post('applyState', 'PurchaseValuationController@applyState');
    Route::post('applyProcesses', 'PurchaseValuationController@applyProcesses');

    // Views Purchase Valuation
    Route::get('purchase_valuation_no_interested', 'PurchaseValuationController@noInterested');
    Route::get('purchase_valuation_interested', 'PurchaseValuationController@interested');

    // AJAX
	Route::post('getModel', 'HomeController@getModel');
    Route::post('getStates', 'StatesController@getStates');
    Route::post('getProcesses', 'ProcessesController@getProcesses');
    Route::post('getEmails', 'EmailsController@getEmails');
    Route::post('getRoles', 'RoleController@getRoles');
    Route::post('getUsers', 'UserController@getUsers');
});

Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });