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

            Route::group(['namespace' => 'Admin'], function () {
                // Event
                Route::get('/admin/event', 'EventController@index')
                    ->name('event');
                Route::post('/admin/event/tambah', 'EventController@tambahEvent')
                    ->name('tambahEvent');
                Route::get('/admin/event/{id}', 'EventController@edit')
                    ->name('editEvent');
                Route::post('/admin/event/update', 'EventController@updateEvent')
                    ->name('updateEvent');
                Route::get('/admin/event/delete/{id}', 'EventController@deleteEvent')
                    ->name('deleteEvent');

                // Mapel
                Route::get('/admin/mapel', 'MapelController@index')
                    ->name('mapel');
                Route::post('/admin/mapel/tambah', 'MapelController@tambahMapel')
                    ->name('tambahMapel');
                Route::get('/admin/mapel/{id}', 'MapelController@edit')
                    ->name('editMapel');
                Route::post('/admin/mapel/update', 'MapelController@updateMapel')
                    ->name('updateMapel');
                Route::get('/admin/mapel/delete/{id}', 'MapelController@delete')
                    ->name('deleteMapel');
            });

        });

    });

Auth::routes();
Route::get('/admin/home', 'HomeController@index')->name('home');
