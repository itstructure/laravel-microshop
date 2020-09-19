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

Route::get('/react', function () {
    return view('react');
});

Route::get('/', 'HomeController@index')->name('home');

Auth::routes();

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
        Route::get('edit/{id}',    ['as' => 'admin_category_edit',   'uses' => 'CategoryController@edit']);
        Route::post('update/{id}', ['as' => 'admin_category_update', 'uses' => 'CategoryController@update']);
        Route::post('delete',      ['as' => 'admin_category_delete', 'uses' => 'CategoryController@delete']);
        Route::get('view/{id}',    ['as' => 'admin_category_view',   'uses' => 'CategoryController@view']);
    });

    Route::group(['prefix'=>'product'], function () {
        Route::get('/',            ['as' => 'admin_product_list',   'uses' => 'ProductController@index']);
        Route::get('create',       ['as' => 'admin_product_create', 'uses' => 'ProductController@create']);
        Route::post('store',       ['as' => 'admin_product_store',  'uses' => 'ProductController@store']);
        Route::get('edit/{id}',    ['as' => 'admin_product_edit',   'uses' => 'ProductController@edit']);
        Route::post('update/{id}', ['as' => 'admin_product_update', 'uses' => 'ProductController@update']);
        Route::post('delete',      ['as' => 'admin_product_delete', 'uses' => 'ProductController@delete']);
        Route::get('view/{id}',    ['as' => 'admin_product_view',   'uses' => 'ProductController@view']);
    });
});
