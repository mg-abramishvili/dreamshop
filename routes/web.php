<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\FrontCatalogController;

// AUTH
Auth::routes([
    'register' => false,
    'reset' => false
]);

// DASHBOARD
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
});

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

// DETAILS (BACKEND)
Route::get('/backend/details', 'App\Http\Controllers\DetailController@index');
Route::get('/backend/details/new', 'App\Http\Controllers\DetailController@create');
Route::post('/backend/details', 'App\Http\Controllers\DetailController@store');
Route::get('/backend/details/{id}/edit', 'App\Http\Controllers\DetailController@edit')->name('detail.edit');
Route::put('/backend/details/{id}/update', 'App\Http\Controllers\DetailController@update');
Route::post('/backend/details/{detail}/new-value', 'App\Http\Controllers\DetailController@addValue')->name('value.add');

// CATALOG (FRONTEND)
Route::get('/catalog', 'App\Http\Controllers\FrontCatalogController@index');