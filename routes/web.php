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
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Auth Admin
        Route::namespace('AuthAdmin')
            ->group(function () {
                Route::get('/login', 'LoginController@loginForm')
                    ->name('loginForm');
                Route::post('/login', 'LoginController@loginSubmit')
                    ->name('loginSubmit');
                Route::post('/logout', 'LoginController@logoutAdmin')
                    ->name('logoutAdmin');
            });

        Route::layout('layouts.base')
        ->middleware(['auth:admin'])
            ->group(function () {
                Route::livewire('/', 'admin.index')
                    ->name('index');
            });
    });


Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
