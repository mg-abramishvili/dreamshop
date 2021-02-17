<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\CategoryController;


// AUTH
Auth::routes([
    'register' => false,
    'reset' => false
]);

// DASHBOARD
Route::get('/dashboard', function () {
    return view('backend.dashboard.index');
});

// CATEGORIES (BACKEND)
Route::get('/backend/categories', 'App\Http\Controllers\CategoryController@index');
Route::get('/backend/categories/new', 'App\Http\Controllers\CategoryController@create');
Route::get('/backend/category/{id}', 'App\Http\Controllers\CategoryController@show');
Route::post('/backend/categories', 'App\Http\Controllers\CategoryController@store');
Route::post('update/{id}', 'App\Http\Controllers\KeyApiController@update');
Route::get('/backend/categories/delete/{id}','App\Http\Controllers\CategoryController@delete')->middleware('auth');
Route::post('/backend/categories/file/{method}','App\Http\Controllers\CategoryController@file')->middleware('auth');