<?php
/*
 * Starter Kit
 */
use App\User;

Route::get('/start', function () {
    //return dd(config('imagecache.templates'));
    return view('decoweb::start');
});
Route::post('/kit',function(){
    if( !empty($_POST['email']) && !empty($_POST['password']) ){
        $admin = new User();
        $admin->name = 'Admin';
        $admin->email = $_POST['email'];
        $admin->password = bcrypt($_POST['password']);
        $admin->save();
        return redirect('/start');
    }
    return redirect('/start');
});
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
Route::get('admin/home', 'Decoweb\Panelpack\Controllers\Admin\HomeController@index');
Route::get('admin/home/account', 'Decoweb\Panelpack\Controllers\Admin\HomeController@account');
Route::put('admin/home/account/update/{id}',[
    'uses'  => 'Decoweb\Panelpack\Controllers\Admin\HomeController@updatePassword',
    'as'    => 'update.password'
]);

/**
 * TABLES
 */
Route::get('admin/table-settings','Decoweb\Panelpack\Controllers\Admin\TablesController@index');
Route::get('admin/table-settings/create','Decoweb\Panelpack\Controllers\Admin\TablesController@create');
Route::get('admin/table-settings/tableDelete/{idTable}','Decoweb\Panelpack\Controllers\Admin\TablesController@delete');
Route::post('admin/table-settings/table','Decoweb\Panelpack\Controllers\Admin\TablesController@store');
Route::post('admin/table-settings/tablesOrder','Decoweb\Panelpack\Controllers\Admin\TablesController@updateOrder');
Route::get('admin/table-settings/{id}/edit','Decoweb\Panelpack\Controllers\Admin\TablesController@edit')->name('tables.edit');
Route::put('admin/table-settings/{table}','Decoweb\Panelpack\Controllers\Admin\TablesController@update')->name('tables.update');

/**
 * RECORDS
 */
Route::match(['get','post'],'admin/core/{tabela}','Decoweb\Panelpack\Controllers\Admin\RecordsController@index');
Route::get('admin/core/{tabela}/create','Decoweb\Panelpack\Controllers\Admin\RecordsController@create');
Route::post('admin/core/{table}/store',[
    'uses' =>'Decoweb\Panelpack\Controllers\Admin\RecordsController@store',
    'as'   => 'store.record'
]);
Route::get('admin/core/{tabela}/edit/{id}','Decoweb\Panelpack\Controllers\Admin\RecordsController@edit');
Route::put('admin/core/{tabela}/update/{id}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\RecordsController@update',
    'as'   => 'record.update'
]);
Route::post('admin/core/{tabela}/recordsActions',[
    'uses'  => 'Decoweb\Panelpack\Controllers\Admin\RecordsController@recordsActions',
    'as'    => 'records.action'
]);
Route::get('admin/core/{tabela}/recordDelete/{id}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\RecordsController@delete',
    'as'   => 'record.delete'
]);
Route::get('admin/core/{tableName}/resetFilters','Decoweb\Panelpack\Controllers\Admin\RecordsController@resetFilters');
Route::post('admin/core/limit/{table}', 'Decoweb\Panelpack\Controllers\Admin\RecordsController@limit');

/**
 * IMAGES
 */
Route::get('admin/core/{tabela}/addPic/{recordId}', 'Decoweb\Panelpack\Controllers\Admin\ImagesController@create');

Route::post('admin/core/{tabela}/storePic/{id}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\ImagesController@store',
    'as'   => 'store.pic'
]);
Route::get('admin/core/deletePic/{idPic}','Decoweb\Panelpack\Controllers\Admin\ImagesController@delete');

Route::post('admin/core/updatePicsOrder/{tableId}/{recordId}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\ImagesController@update',
    'as'   => 'update.picsOrder'
]);

/**
 * FILES
 */
Route::get('admin/core/{tabela}/addFile/{recordId}', 'Decoweb\Panelpack\Controllers\Admin\FilesController@create');

Route::post('admin/core/{tabela}/storeFile/{id}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\FilesController@store',
    'as'   => 'store.file'
]);
Route::get('admin/core/deleteFile/{fileId}','Decoweb\Panelpack\Controllers\Admin\FilesController@delete');

Route::post('admin/core/updateFilesOrder/{tableId}/{recordId}',[
    'uses' => 'Decoweb\Panelpack\Controllers\Admin\FilesController@update',
    'as'   => 'update.filesOrder'
]);
/**
 * TRANSPORT
 */
Route::get('admin/shop/transport','Decoweb\Panelpack\Controllers\Admin\TransportController@index');
Route::get('admin/shop/transport/create','Decoweb\Panelpack\Controllers\Admin\TransportController@create');
Route::post('admin/shop/transport','Decoweb\Panelpack\Controllers\Admin\TransportController@store');
Route::post('admin/shop/transport/updateOrder','Decoweb\Panelpack\Controllers\Admin\TransportController@updateOrder');
Route::get('admin/shop/transport/{id}/edit','Decoweb\Panelpack\Controllers\Admin\TransportController@edit');
Route::put('admin/shop/transport/{id}','Decoweb\Panelpack\Controllers\Admin\TransportController@update');
Route::get('admin/shop/transport/{id}/delete','Decoweb\Panelpack\Controllers\Admin\TransportController@destroy');
/**
 * CUSTOMERS
 */
Route::get('admin/shop/customers','Decoweb\Panelpack\Controllers\Admin\CustomerController@index');
Route::post('admin/shop/customers','Decoweb\Panelpack\Controllers\Admin\CustomerController@store');
Route::post('admin/shop/customers/updateLimit','Decoweb\Panelpack\Controllers\Admin\CustomerController@updateLimit');
Route::get('admin/shop/customers/create','Decoweb\Panelpack\Controllers\Admin\CustomerController@create');
Route::get('admin/shop/customers/{id}/edit','Decoweb\Panelpack\Controllers\Admin\CustomerController@edit');
Route::put('admin/shop/customers/{id}','Decoweb\Panelpack\Controllers\Admin\CustomerController@update');
Route::get('admin/shop/customers/{id}/delete','Decoweb\Panelpack\Controllers\Admin\CustomerController@destroy');
Route::post('admin/shop/customers/deleteMultiple','Decoweb\Panelpack\Controllers\Admin\CustomerController@deleteMultiple');
/**
 * INVOICES
 */
Route::get('admin/shop/invoice','Decoweb\Panelpack\Controllers\Admin\InvoiceController@index');
Route::get('cart/vizualizareProforma/{id}/{code}','Decoweb\Panelpack\Controllers\ProformaController@index');
Route::put('admin/shop/invoice/{id}','Decoweb\Panelpack\Controllers\Admin\InvoiceController@update');
/**
 * STATUSES
 */
Route::get('admin/shop/statuses','Decoweb\Panelpack\Controllers\Admin\StatusController@index');
Route::get('admin/shop/statuses/{id}/edit','Decoweb\Panelpack\Controllers\Admin\StatusController@edit');
Route::put('admin/shop/statuses/{id}','Decoweb\Panelpack\Controllers\Admin\StatusController@update');
/**
 * ORDERS
 */
Route::resource('admin/shop/orders', 'Decoweb\Panelpack\Controllers\Admin\OrdersController', ['except' => [
    'create', 'store', 'show', 'destroy'
]]);
Route::get('admin/shop/orders/{id}/delete/','Decoweb\Panelpack\Controllers\Admin\OrdersController@destroy');
Route::put('admin/shop/orders/{id}/updateStatus/','Decoweb\Panelpack\Controllers\Admin\OrdersController@updateStatus');
Route::post('admin/shop/orders/{id}/updateQuantity/','Decoweb\Panelpack\Controllers\Admin\OrdersController@updateQuantity');
Route::put('admin/shop/orders/{id}/updateTransportPrice/','Decoweb\Panelpack\Controllers\Admin\OrdersController@updateTransportPrice');
Route::get('admin/shop/orders/{order}/item/{orderedItem}/delete/','Decoweb\Panelpack\Controllers\Admin\OrdersController@destroyItem');
Route::post('admin/shop/ordersByStatus','Decoweb\Panelpack\Controllers\Admin\OrdersController@ordersByStatus');
Route::post('admin/shop/orders/updateLimit','Decoweb\Panelpack\Controllers\Admin\OrdersController@updateLimit');
Route::post('admin/shop/orders/deleteMultiple','Decoweb\Panelpack\Controllers\Admin\OrdersController@deleteMultiple');
/**
 * GOOGLE MAP
 */
Route::get('admin/maps','Decoweb\Panelpack\Controllers\Admin\MapsController@index');
Route::post('admin/maps/update','Decoweb\Panelpack\Controllers\Admin\MapsController@update');
/**
 * SETTINGS
 */
Route::get('admin/settings','Decoweb\Panelpack\Controllers\Admin\SettingsController@index');
Route::get('admin/settings/social','Decoweb\Panelpack\Controllers\Admin\SettingsController@social');
Route::post('admin/settings/update','Decoweb\Panelpack\Controllers\Admin\SettingsController@update');
Route::post('admin/settings/social/update','Decoweb\Panelpack\Controllers\Admin\SettingsController@updateSocial');
/**
 * SITEMAP
 */
Route::get('admin/sitemap','Decoweb\Panelpack\Controllers\Admin\SitemapController@index');
Route::post('admin/sitemap/regenerate','Decoweb\Panelpack\Controllers\Admin\SitemapController@regenerate');