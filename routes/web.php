<?php

// Admin Session //
Route::name('admin.')
    ->group(function () {
        // Login/Logout/Form
        Route::group(['namespace' => 'AuthAdmin'], function () {
            Route::get('/admin/login', 'LoginController@loginForm')
                ->name('loginForm');
            Route::post('/admin/login', 'LoginController@loginSubmit')
                ->name('loginSubmit');
            Route::post('/admin/logout', 'LoginController@logoutAdmin')
                ->name('logoutAdmin');
        });

        // Dashboard Page
        Route::group(['middleware' => 'auth:admin'], function () {
            Route::view('/admin/', 'admin.index')
                ->name('index');

            // Event
            Route::group(['namespace' => 'Admin'], function () {
                Route::get('/admin/event', 'EventController@index')
                    ->name('event');
                Route::post('/admin/event/tambah', 'EventController@tambahEvent')
                    ->name('tambahEvent');
                Route::post('/admin/event/update', 'EventController@updateEvent')
                    ->name('updateEvent');
                Route::get('/admin/event/{id}', 'EventController@edit')
                    ->name('edit');
            });

        });

    });

Auth::routes();
Route::get('/admin/home', 'HomeController@index')->name('home');
