<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CatalogController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontCatalogController;

// AUTH
Auth::routes([
    'register' => false,
    'reset' => false
]);

// DASHBOARD
Route::get('/backend/dashboard', 'App\Http\Controllers\DashboardController@index');

// CATALOG (BACKEND)
Route::get('/backend/catalog', 'App\Http\Controllers\CatalogController@index');
Route::get('/backend/catalog/new-category/{current_category}', 'App\Http\Controllers\CatalogController@create_category');
Route::get('/backend/catalog/category/{id}', 'App\Http\Controllers\CatalogController@show_category');
Route::post('/backend/catalog', 'App\Http\Controllers\CatalogController@store_category');
Route::post('/backend/catalog/update/{id}', 'App\Http\Controllers\CatalogController@update');
Route::get('/backend/catalog/delete/{id}','App\Http\Controllers\CatalogController@delete')->middleware('auth');
Route::post('/backend/catalog/file/{method}','App\Http\Controllers\CatalogController@file')->middleware('auth');
Route::get('/backend/catalog/new-product/{current_category}', 'App\Http\Controllers\CatalogController@create_product');
Route::post('/backend/catalog-products', 'App\Http\Controllers\CatalogController@store_product');
Route::get('/backend/catalog/product/{id}/edit', 'App\Http\Controllers\CatalogController@edit_product')->name('product.edit');
Route::post('/backend/catalog/product/attribute/{id}/new', 'App\Http\Controllers\CatalogController@add_attribute')->name('product.attribute.new');

// ATTRIBUTES (BACKEND)
Route::get('/backend/attributes', 'App\Http\Controllers\AttributeController@index');
Route::get('/backend/attributes/new', 'App\Http\Controllers\AttributeController@create');
Route::post('/backend/attributes', 'App\Http\Controllers\AttributeController@store');
Route::get('/backend/attributes/{id}/edit', 'App\Http\Controllers\AttributeController@edit')->name('attribute.edit');
Route::put('/backend/attributes/{id}/update', 'App\Http\Controllers\AttributeController@update');
Route::post('/backend/attributes/{attribute}/new-value', 'App\Http\Controllers\AttributeController@addValue')->name('value.add');

// CATALOG (FRONTEND)
Route::get('/catalog', 'App\Http\Controllers\FrontCatalogController@index');