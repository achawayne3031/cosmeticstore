<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

/*
Route::get('/', function () {
    return view('welcome');
});

*/

Route::get('/', 'ProductsController@index')->name('homepage');
Auth::routes();

/////////////Page Router//////////
//Route::get('/item/{id}', 'ProductsController@show');
Route::resource('item', 'ItemController');
Route::get('/contact', 'ProductsController@contact');
Route::get('/shop', 'ProductsController@shop');



/////////////Cart Router//////////////

Route::post('/item/{id}/add', 'cartControl@add');
Route::get('/cart', 'cartControl@view');
Route::put('/cart', 'cartControl@update');
Route::delete('/cart', 'cartControl@remove');
Route::get('/cart/{msg}', 'cartControl@ordered');


/////////////////Place Order////////////
Route::get('/order', 'PlaceOrder@transit');
//Route::post('/order', 'PlaceOrder@saveOrder');
Route::get('/state', 'PlaceOrder@getState');
Route::get('/local', 'PlaceOrder@getLocal');


Route::post('/paystack', 'PlaceOrder@pay');
Route::post('/store-payment-details', 'PlaceOrder@saveOrder');
Route::post('/store-payment-from-account', 'PlaceOrder@saveOrderFromAccount');

//////////////////////Category Router////////////////////////
Route::get('/category/skin-care', 'categoryController@skin');
Route::get('/category/face-care', 'categoryController@face');
Route::get('/category/fragrance', 'categoryController@fragrance');
Route::get('/category/make-up', 'categoryController@make');
Route::get('/category/bath-body', 'categoryController@bath');
Route::get('/category/foot-care', 'categoryController@foot');
Route::get('/category/hair-care', 'categoryController@hair');

////////////////// User Dashboard///////////
Route::get('/user-profile', 'userController@profile')->middleware('auth');
Route::get('/user-orders', 'userController@orders')->middleware('auth');
///Route::get('/user-dashboard', 'userController@dashboard')->middleware('auth');
Route::get('/fund-account', 'userController@fund')->middleware('auth');
Route::post('/user-fund-account', 'userController@userFundAccount')->middleware('auth');
Route::post('/user-update-password', 'userController@updatePassword')->middleware('auth');
Route::get('/see-order/{ref}', 'userController@seeOrder')->middleware('auth');
Route::get('/user/password', 'userController@showPasswordView');
Route::post('/check-email', 'userController@checkEmailDB');
Route::post('/change-password', 'userController@changeUserPassword');





//////////// Search Router////////////
Route::get('/search', 'categoryController@search');

/////////// Review Router/////////
Route::post('/review/save', 'StarController@submitReview');

/////////////// Email Newsletter////////////////////
Route::post('/newsletter-email', 'ProductsController@newsletter');



////////////////Admin Router////////////////////
Route::get('/admin/reg-users', 'AdminController@regUsers')->middleware('auth:manager');
Route::post('/admin/reg-users', 'AdminController@delUsers')->middleware('auth:manager');
Route::get('/admin/dashboard', 'AdminController@dashboard')->middleware('auth:manager');
Route::get('/admin/items', 'AdminController@items')->middleware('auth:manager');
Route::get('/admin/sales-detail', 'AdminController@salesDetail')->middleware('auth:manager');
Route::get('/admin/orders', 'AdminController@orders')->middleware('auth:manager'); 
Route::get('/admin/see-detail/{ref}', 'AdminController@seeDetail')->middleware('auth:manager'); 
Route::get('/admin/most-orders', 'AdminController@mostOrder')->middleware('auth:manager'); 
Route::get('/admin/top-view', 'AdminController@topView')->middleware('auth:manager');
Route::get('/admin/out-of-stock', 'AdminController@outOfStock')->middleware('auth:manager');;
Route::get('/admin/fund-user/{id}', 'AdminController@fundUser')->middleware('auth:manager');
Route::get('/admin/fund', 'AdminController@fund')->middleware('auth:manager');
Route::post('/admin/fund-user-account', 'AdminController@adminFundUser')->middleware('auth:manager');
Route::resource('admin', 'AdminController')->middleware('auth:manager'); 
Route::post('/create-product', 'AdminController@createProduct')->middleware('auth:manager');
Route::get('/login/admin', 'AdminController@showManagerLoginForm');
Route::get('/register/admin', 'AdminController@showManagerRegisterForm');
Route::post('/login/admin', 'AdminController@managerLogin');
Route::post('/register/admin', 'AdminController@createManager');





