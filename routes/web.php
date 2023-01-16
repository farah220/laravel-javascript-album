<?php

use Illuminate\Support\Facades\Route;

Route::view('/home','web.index')->name('web.index')->middleware('web');

Route::view('/','auth.login-form')->name('web.login-form');
Route::view('/register','auth.register-form')->name('web.register-form');
Route::post('/login','App\Http\Controllers\AuthController@login')->name('web.login');
Route::post('/register','App\Http\Controllers\AuthController@register')->name('web.register');
Route::post('/logout','App\Http\Controllers\AuthController@logout')->name('web.logout');

Route::resource('albums','App\Http\Controllers\AlbumController')->only(['store','index','destroy']);
Route::resource('images','App\Http\Controllers\ImageController')->only(['store','index']);
Route::get('/albums/{album}/','App\Http\Controllers\AlbumController@show')->name('web.album');
