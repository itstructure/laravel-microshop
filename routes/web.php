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

Route::get('/', 'HomeController@index')->name('home');
Route::get('/products/{alias}', 'HomeController@products')->name('category_products');
Route::get('/card', 'CardController@index')->name('card');

Auth::routes();

/*
|--------------------------------------------------------------------------
| Order section.
|--------------------------------------------------------------------------
*/
Route::group(['namespace' => 'Ajax'], function () {

    Route::post('/put-to-card',       ['as' => 'put_to_card',       'uses' => 'OrderAjaxController@putToCard']);
    Route::post('/set-count-in-card', ['as' => 'set_count_in_card', 'uses' => 'OrderAjaxController@setCountInCard']);
    Route::post('/remove-from-card',  ['as' => 'remove_from_card',  'uses' => 'OrderAjaxController@removeFromCard']);
    Route::post('/send-order',        ['as' => 'send_order',        'uses' => 'OrderAjaxController@sendOrder']);
});

/*
|--------------------------------------------------------------------------
| Admin section.
|--------------------------------------------------------------------------
*/
Route::group(['prefix'=>'admin', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {

    Route::get('/', ['as' => 'admin_page', 'uses' => 'CategoryController@index']);

    Route::group(['prefix'=>'category'], function () {
        Route::get('/',            ['as' => 'admin_category_list',   'uses' => 'CategoryController@index']);
        Route::get('create',       ['as' => 'admin_category_create', 'uses' => 'CategoryController@create']);
        Route::post('store',       ['as' => 'admin_category_store',  'uses' => 'CategoryController@store']);
        Route::get('edit/{id}',    ['as' => 'admin_category_edit',   'uses' => 'CategoryController@edit'])->where('id','\d+');
        Route::post('update/{id}', ['as' => 'admin_category_update', 'uses' => 'CategoryController@update'])->where('id','\d+');
        Route::post('delete',      ['as' => 'admin_category_delete', 'uses' => 'CategoryController@delete']);
        Route::get('view/{id}',    ['as' => 'admin_category_view',   'uses' => 'CategoryController@view'])->where('id','\d+');
    });

    Route::group(['prefix'=>'product'], function () {
        Route::get('/',            ['as' => 'admin_product_list',   'uses' => 'ProductController@index']);
        Route::get('create',       ['as' => 'admin_product_create', 'uses' => 'ProductController@create']);
        Route::post('store',       ['as' => 'admin_product_store',  'uses' => 'ProductController@store']);
        Route::get('edit/{id}',    ['as' => 'admin_product_edit',   'uses' => 'ProductController@edit'])->where('id','\d+');
        Route::post('update/{id}', ['as' => 'admin_product_update', 'uses' => 'ProductController@update'])->where('id','\d+');
        Route::post('delete',      ['as' => 'admin_product_delete', 'uses' => 'ProductController@delete']);
        Route::get('view/{id}',    ['as' => 'admin_product_view',   'uses' => 'ProductController@view'])->where('id','\d+');
    });

    Route::group(['prefix'=>'order'], function () {
        Route::get('/',            ['as' => 'admin_order_list',   'uses' => 'OrderController@index']);
        Route::post('delete',      ['as' => 'admin_order_delete', 'uses' => 'OrderController@delete']);
    });
});
