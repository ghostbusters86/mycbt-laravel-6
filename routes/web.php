<?php

// Admin Session //
Route::prefix('admin')
    ->name('admin.')
    ->group(function () {
        // Login/Logout/Form
        Route::namespace('AuthAdmin')
            ->group(function () {
                Route::get('/login', 'LoginController@loginForm')
                    ->name('loginForm');
                Route::post('/login', 'LoginController@loginSubmit')
                    ->name('loginSubmit');
                Route::post('/logout', 'LoginController@logoutAdmin')
                    ->name('logoutAdmin');
            });

        Route::middleware(['auth:admin'])
            ->group(function () {
                // Page
            });
    });

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
