<?php
 
Route::get('/', 'FrontendController@index');
Route::get('motos', 'FrontendController@motos');
Route::get('cart', 'FrontendController@cart');
Route::get('contacto', 'FrontendController@contacto');
Route::get('ver-moto/{id}', 'FrontendController@verMoto');

Route::auth();

Route::resource('purchase_management', 'PurchaseManagementController');

Route::resource('purchase_management', 'PurchaseManagementController');
Route::get('purchase_management/create/{purchase_valuation_id}', 'PurchaseManagementController@create');
Route::resource('motos-que-nos-ofrecen', 'PurchaseValuationController');
Route::post('getModel', 'HomeController@getModel');


Route::group(['middleware' => 'auth'], function () {
	Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::post('uploadDocument', 'PurchaseValuationController@uploadDocument');    
    Route::post('uploadImage', 'PurchaseValuationController@uploadImage');    

    Route::resource('empleados', 'UserController');
    Route::resource('perfiles', 'RoleController');
    Route::resource('permisos', 'PermissionsController');
    Route::get('profile/{id}', 'UserController@profile')->name('profile');
    Route::post('update_profile', 'UserController@updateProfile')->name('updateProfile');
    Route::post('update_password', 'UserController@updatePassword')->name('updatePassword');
    Route::resource('estados-gc', 'StatesController');
    Route::resource('mensajes-gc', 'EmailsController');
    Route::resource('procesos', 'ProcessesController');
    Route::resource('formularios', 'FormsController');
    Route::resource('documentos-gc', 'DocumentsPurchaseValuationController');
    Route::resource('empresas', 'BusinessController');
    Route::resource('servicios', 'ServicesController');

    Route::post('show-images', 'PurchaseValuationController@showImages');

    // Apply Functions in Purchase Valuation
    Route::post('applyState', 'PurchaseValuationController@applyState');
    Route::post('applyProcesses', 'PurchaseValuationController@applyProcesses');

    // Views Purchase Valuation
    Route::get('purchase_valuation_no_interested', 'PurchaseValuationController@noInterested');
    Route::get('purchase_valuation_interested', 'PurchaseValuationController@interested');
    Route::get('purchase_valuation_interested/ficha_de_la_moto', 'PurchaseValuationController@showFicha');
    Route::get('purchase_valuation_interested/ficha_de_la_moto/{id}', 'PurchaseValuationController@getDataFicha');
    Route::post('purchase_valuation_interested/update_ficha', 'PurchaseValuationController@updateFicha')->name('updateFicha');

    //Change Status Views
    Route::post('empleados/change_status_user', 'UserController@changeStatus');

    //Publish Moto to frontend
    Route::post('empleados/change_status_user', 'UserController@changeStatus');

    //getData from prestashop
    Route::post('motos-que-nos-ofrecen/subasta', 'PurchaseValuationController@PublishMotocycle');
    Route::post('motos-que-nos-ofrecen/verificar', 'PurchaseValuationController@verifyFicha');

    // AJAX
    Route::post('getStates', 'StatesController@getStates');
    Route::post('getProcesses', 'ProcessesController@getProcesses');
    Route::post('getEmails', 'EmailsController@getEmails');
    Route::post('getRoles', 'RoleController@getRoles');
    Route::post('getUsers', 'UserController@getUsers');
    Route::post('getPurchaseValuations', 'PurchaseValuationController@getPurchaseValuations');
    Route::post('getPurchaseValuationsInterested', 'PurchaseValuationController@getPurchaseValuationsInterested');
    Route::post('getPurchaseValuationsNoInterested', 'PurchaseValuationController@getPurchaseValuationsNoInterested');
    Route::post('getPurchaseValuationsScrapping', 'PurchaseValuationController@getPurchaseValuationsScrapping');
    Route::post('getPurchaseValuationsSale', 'PurchaseValuationController@getPurchaseValuationsSale');
    Route::post('getPurchaseValuationsAuction', 'PurchaseValuationController@getPurchaseValuationsAuction');

    Route::post('getForms', 'FormsController@getForms');
    Route::post('getDocumentsPurchaseValuations', 'DocumentsPurchaseValuationController@getDocumentsPurchaseValuations');
    Route::post('getServices', 'ServicesController@getServices');

    // GET FILES
    Route::get('document/{filename}', 'PurchaseValuationController@document');
    Route::get('image/{filename}', 'PurchaseValuationController@image');
});

Route::get('/config-cache', function() {      $exitCode = Artisan::call('config:cache');      return '<h1>Clear Config cleared</h1>';  });