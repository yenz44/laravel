<?php

use Illuminate\Support\Facades\Route;



Route::resource('/products', 'ProductController');


Route::get('/', function () {
    return view('welcome');
});

Auth::routes();
Route::resource('/products', 'ProductController');
Route::get('/home', 'HomeController@index')->name('home');


/*
yenz
*/