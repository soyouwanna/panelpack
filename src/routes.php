<?php
Route::get('tester', function(){
    return 555;
})->middleware('web');

# customer
Route::get('/customer/login/{cart?}','Decoweb\Panelpack\Controllers\CustomerAuth\LoginController@showLoginForm');
Route::post('/customer/login','Decoweb\Panelpack\Controllers\CustomerAuth\LoginController@login');
Route::get('/customer/logout','Decoweb\Panelpack\Controllers\CustomerAuth\LoginController@logout');
Route::put('customer/profile/{id}','Decoweb\Panelpack\Controllers\CustomerController@update');
Route::get('customer/profile','Decoweb\Panelpack\Controllers\CustomerController@profile');
Route::get('customer/myOrders','Decoweb\Panelpack\Controllers\CustomerController@myOrders');
Route::get('customer/newPassword','Decoweb\Panelpack\Controllers\CustomerController@newPassword');
Route::post('customer/updatePassword/{id}','Decoweb\Panelpack\Controllers\CustomerController@updatePassword');
Route::get('customer/go','Decoweb\Panelpack\Controllers\CustomerController@go');
// Registration Routes...
Route::get('customer/confirmemail/{token}', 'Decoweb\Panelpack\Controllers\CustomerAuth\PostRegisterController@confirmEmail');
Route::get('customer/register', 'Decoweb\Panelpack\Controllers\CustomerAuth\RegisterController@showRegistrationForm');
Route::post('customer/register', 'Decoweb\Panelpack\Controllers\CustomerAuth\RegisterController@register');
Route::get('customer/password/reset/{token}', 'Decoweb\Panelpack\Controllers\CustomerAuth\ResetPasswordController@showResetForm');
Route::post('customer/password/reset', 'Decoweb\Panelpack\Controllers\CustomerAuth\ResetPasswordController@reset');
Route::get('customer/password/reset', 'Decoweb\Panelpack\Controllers\CustomerAuth\ForgotPasswordController@showLinkRequestForm');
Route::post('customer/password/email', 'Decoweb\Panelpack\Controllers\CustomerAuth\ForgotPasswordController@sendResetLinkEmail');
// Facebook Login Routes
Route::get('auth/facebook', 'Decoweb\Panelpack\Controllers\CustomerAuth\FbauthController@redirectToProvider');
Route::get('auth/facebook/callback', 'Decoweb\Panelpack\Controllers\CustomerAuth\FbauthController@handleProviderCallback');


Route::get('admin/login', 'Decoweb\Panelpack\Controllers\Auth\LoginController@showLoginForm')->name('login');
Route::post('admin/login', 'Decoweb\Panelpack\Controllers\Auth\LoginController@login');
Route::post('admin/logout', 'Decoweb\Panelpack\Controllers\Auth\LoginController@logout')->name('logout');

// Cart routes
Route::post('addCart','Decoweb\Panelpack\Controllers\CartController@addCart')->name('addCart');
Route::get('cart','Decoweb\Panelpack\Controllers\CartController@index');
Route::get('cart/destroy','Decoweb\Panelpack\Controllers\CartController@cartDestroy');
Route::get('cart/deleteItem/{rowId}','Decoweb\Panelpack\Controllers\CartController@deleteItem');
Route::get('cart/checkout2','Decoweb\Panelpack\Controllers\CartController@checkout2');
Route::get('cart/checkout3','Decoweb\Panelpack\Controllers\CartController@checkout3');
Route::get('cart/checkout4','Decoweb\Panelpack\Controllers\CartController@checkout4');
Route::post('cart/storeOrder/','Decoweb\Panelpack\Controllers\CartController@storeOrder');
Route::post('cart/modalInfo','Decoweb\Panelpack\Controllers\CartController@modalInfo');
Route::post('cart/update','Decoweb\Panelpack\Controllers\CartController@update');

/***************************
 *
 * ADMIN ROUTES
 *
 ***************************/
Route::get('admin/home', 'admin\HomeController@index');
Route::get('admin/home/account', 'admin\HomeController@account');
Route::put('admin/home/account/update/{id}',[
    'uses'  => 'admin\HomeController@updatePassword',
    'as'    => 'update.password'
]);

/**
 * TABLES
 */
Route::get('admin/table-settings','admin\TablesController@index');
Route::get('admin/table-settings/create','admin\TablesController@create');
Route::get('admin/table-settings/tableDelete/{idTable}','admin\TablesController@delete');
Route::post('admin/table-settings/table','admin\TablesController@store');
Route::post('admin/table-settings/tablesOrder','admin\TablesController@updateOrder');
Route::get('admin/table-settings/{id}/edit','admin\TablesController@edit')->name('tables.edit');
Route::put('admin/table-settings/{table}','admin\TablesController@update')->name('tables.update');

/**
 * RECORDS
 */
Route::match(['get','post'],'admin/core/{tabela}','admin\RecordsController@index');
Route::get('admin/core/{tabela}/create','admin\RecordsController@create');
Route::post('admin/core/{table}/store',[
    'uses' =>'admin\RecordsController@store',
    'as'   => 'store.record'
]);
Route::get('admin/core/{tabela}/edit/{id}','admin\RecordsController@edit');
Route::put('admin/core/{tabela}/update/{id}',[
    'uses' => 'admin\RecordsController@update',
    'as'   => 'record.update'
]);
Route::post('admin/core/{tabela}/recordsActions',[
    'uses'  => 'admin\RecordsController@recordsActions',
    'as'    => 'records.action'
]);
Route::get('admin/core/{tabela}/recordDelete/{id}',[
    'uses' => 'admin\RecordsController@delete',
    'as'   => 'record.delete'
]);
Route::get('admin/core/{tableName}/resetFilters','admin\RecordsController@resetFilters');
Route::post('admin/core/limit/{table}', 'admin\RecordsController@limit');

/**
 * IMAGES
 */
Route::get('admin/core/{tabela}/addPic/{recordId}', 'admin\ImagesController@create');

Route::post('admin/core/{tabela}/storePic/{id}',[
    'uses' => 'admin\ImagesController@store',
    'as'   => 'store.pic'
]);
Route::get('admin/core/deletePic/{idPic}','admin\ImagesController@delete');

Route::post('admin/core/updatePicsOrder/{tableId}/{recordId}',[
    'uses' => 'admin\ImagesController@update',
    'as'   => 'update.picsOrder'
]);

/**
 * FILES
 */
Route::get('admin/core/{tabela}/addFile/{recordId}', 'admin\FilesController@create');

Route::post('admin/core/{tabela}/storeFile/{id}',[
    'uses' => 'admin\FilesController@store',
    'as'   => 'store.file'
]);
Route::get('admin/core/deleteFile/{fileId}','admin\FilesController@delete');

Route::post('admin/core/updateFilesOrder/{tableId}/{recordId}',[
    'uses' => 'admin\FilesController@update',
    'as'   => 'update.filesOrder'
]);
/**
 * TRANSPORT
 */
Route::get('admin/shop/transport','admin\TransportController@index');
Route::get('admin/shop/transport/create','admin\TransportController@create');
Route::post('admin/shop/transport','admin\TransportController@store');
Route::post('admin/shop/transport/updateOrder','admin\TransportController@updateOrder');
Route::get('admin/shop/transport/{id}/edit','admin\TransportController@edit');
Route::put('admin/shop/transport/{id}','admin\TransportController@update');
Route::get('admin/shop/transport/{id}/delete','admin\TransportController@destroy');
/**
 * CUSTOMERS
 */
Route::get('admin/shop/customers','admin\CustomerController@index');
Route::post('admin/shop/customers','admin\CustomerController@store');
Route::post('admin/shop/customers/updateLimit','admin\CustomerController@updateLimit');
Route::get('admin/shop/customers/create','admin\CustomerController@create');
Route::get('admin/shop/customers/{id}/edit','admin\CustomerController@edit');
Route::put('admin/shop/customers/{id}','admin\CustomerController@update');
Route::get('admin/shop/customers/{id}/delete','admin\CustomerController@destroy');
Route::post('admin/shop/customers/deleteMultiple','admin\CustomerController@deleteMultiple');
/**
 * INVOICES
 */
Route::get('admin/shop/invoice','admin\InvoiceController@index');
Route::get('cart/vizualizareProforma/{id}/{code}','ProformaController@index');
Route::put('admin/shop/invoice/{id}','admin\InvoiceController@update');
/**
 * STATUSES
 */
Route::get('admin/shop/statuses','admin\StatusController@index');
Route::get('admin/shop/statuses/{id}/edit','admin\StatusController@edit');
Route::put('admin/shop/statuses/{id}','admin\StatusController@update');
/**
 * ORDERS
 */
Route::resource('admin/shop/orders', 'admin\OrdersController', ['except' => [
    'create', 'store', 'show', 'destroy'
]]);
Route::get('admin/shop/orders/{id}/delete/','admin\OrdersController@destroy');
Route::put('admin/shop/orders/{id}/updateStatus/','admin\OrdersController@updateStatus');
Route::post('admin/shop/orders/{id}/updateQuantity/','admin\OrdersController@updateQuantity');
Route::put('admin/shop/orders/{id}/updateTransportPrice/','admin\OrdersController@updateTransportPrice');
Route::get('admin/shop/orders/{order}/item/{orderedItem}/delete/','admin\OrdersController@destroyItem');
Route::post('admin/shop/ordersByStatus','admin\OrdersController@ordersByStatus');
Route::post('admin/shop/orders/updateLimit','admin\OrdersController@updateLimit');
Route::post('admin/shop/orders/deleteMultiple','admin\OrdersController@deleteMultiple');
/**
 * GOOGLE MAP
 */
Route::get('admin/maps','admin\MapsController@index');
Route::post('admin/maps/update','admin\MapsController@update');
/**
 * SETTINGS
 */
Route::get('admin/settings','admin\SettingsController@index');
Route::get('admin/settings/social','admin\SettingsController@social');
Route::post('admin/settings/update','admin\SettingsController@update');
Route::post('admin/settings/social/update','admin\SettingsController@updateSocial');
/**
 * SITEMAP
 */
Route::get('admin/sitemap','admin\SitemapController@index');
Route::post('admin/sitemap/regenerate','admin\SitemapController@regenerate');