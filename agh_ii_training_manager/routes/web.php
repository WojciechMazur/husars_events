<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::resources([
    'products' => 'ProductController',
    'profile' => 'ProfileController',
    'users' => 'UsersController',
    'orders' => 'OrderController',
    'orderItems' => 'OrderItemsController',
    'trainings' => 'TrainingsController',
    'races' => 'RaceController'
]);

Route::get('products/add-to-cart/{id}', [
    'uses'=> 'ProductController@addToCart',
    'as' => 'products.addToCart'
]);

Route::delete('shop/shopping-cart/remove/{id}', 'ProductController@removeFromShoppingCart')
    ->name('shop.shopping-cart.item.remove');
Route::put('shop/shopping-cart/edit', 'ProductController@editShoppingCart')
    ->name('shop.shopping-cart.edit');
Route::get('shop/shopping-cart/', 'ProductController@getShoppingCart')->name('shop.shopping-cart');

Route::get('shop/shopping-cart/submit', 'OrderController@getSubmitOrderView')->name('shop.shopping-cart.submit');
Route::post('shop/shopping-cart/submit', 'OrderController@submitOrderView')->name('post.shop.shopping-cart.submit');

Route::get('orders/codes/{code}', 'OrderController@statusCodeDescription')->name('status-code');
Route::get('orders/status/codes', 'OrderController@statusCodes')->name('status-codes');
Route::get('orders/{id}/items', 'OrderController@orderItems');

Route::post('/races/register','RaceController@raceRegistration' );
Route::delete('/races/register/{id}', 'RaceController@raceRegistrationCancel');

Route::post('trainings/reservation','TrainingsController@addTrainingReservation');
Route::delete('trainings/reservation/{id}','TrainingsController@deleteTrainingReservation');

Auth::routes();

Route::get('admin/register', 'AdminAuth\RegisterController@showRegistrationForm');
Route::post('admin/register', 'AdminAuth\RegisterController@register')->name("admin.register");
Route::get('admin/login', 'AdminAuth\LoginController@showLoginForm');
Route::post('admin/login', 'AdminAuth\LoginController@login')->name("admin.login");
Route::post('admin/logout', 'AdminAuth\LoginController@logout')->name("admin.logout");


Route::get('/admin/home', 'HomeController@index')->name('admin.home');
Route::get('/admin', 'HomeController@index');
