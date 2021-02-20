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

// PRODUCTS (BACKEND)
Route::get('/backend/products', 'App\Http\Controllers\ProductController@index');
Route::get('/backend/products/new', 'App\Http\Controllers\ProductController@create');
Route::get('/backend/product/{id}', 'App\Http\Controllers\ProductController@show');
Route::post('/backend/products', 'App\Http\Controllers\ProductController@store');
Route::post('update/{id}', 'App\Http\Controllers\ProductController@update');
Route::get('/backend/products/delete/{id}','App\Http\Controllers\ProductController@delete')->middleware('auth');
Route::post('/backend/products/file/{method}','App\Http\Controllers\ProductController@file')->middleware('auth');

// CATEGORIES (BACKEND)
Route::get('/backend/categories', 'App\Http\Controllers\CategoryController@index');
Route::get('/backend/categories/new', 'App\Http\Controllers\CategoryController@create');
Route::get('/backend/category/{id}', 'App\Http\Controllers\CategoryController@show');
Route::post('/backend/categories', 'App\Http\Controllers\CategoryController@store');
Route::post('update/{id}', 'App\Http\Controllers\KeyApiController@update');
Route::get('/backend/categories/delete/{id}','App\Http\Controllers\CategoryController@delete')->middleware('auth');
Route::post('/backend/categories/file/{method}','App\Http\Controllers\CategoryController@file')->middleware('auth');

// ATTRIBUTES (BACKEND)
Route::get('/backend/attributes', 'App\Http\Controllers\AttributeController@index');
Route::get('/backend/attributes/new', 'App\Http\Controllers\AttributeController@create');
Route::post('/backend/attributes', 'App\Http\Controllers\AttributeController@store');
Route::get('/backend/attributes/{id}/edit', 'App\Http\Controllers\AttributeController@edit')->name('attribute.edit');
Route::put('/backend/attributes/{id}/update', 'App\Http\Controllers\AttributeController@update');
Route::post('/backend/attributes/{attribute}/new-value', 'App\Http\Controllers\AttributeController@addValue')->name('value.add');

// CATALOG (FRONTEND)
Route::get('/catalog', 'App\Http\Controllers\FrontCatalogController@index');