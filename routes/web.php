<?php

// Admin Session //
Route::group(['prefix' => 'admin', 'name' => 'admin.'], function () {
    // Login/Logout/Form
    Route::group(['namespace' => 'AuthAdmin'], function () {
        Route::get('/login', 'LoginController@loginForm')
            ->name('loginForm');
        Route::post('/login', 'LoginController@loginSubmit')
            ->name('loginSubmit');
        Route::post('/logout', 'LoginController@logoutAdmin')
            ->name('logoutAdmin');
    });

    // Dashboard Page
    Route::group(['middleware' => 'auth:admin'], function () {
        Route::view('/', 'admin.index')
            ->name('index');
        Route::view('/event', 'admin.event.event')
            ->name('event');
    });
});

Auth::routes();
Route::get('/home', 'HomeController@index')->name('home');
