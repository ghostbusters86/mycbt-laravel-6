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
        Route::group(['namespace' => 'Admin', 'middleware' => 'auth:admin'], function () {
            Route::view('/admin/', 'admin.index')
                ->name('index');

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
            Route::get('/admin/mapel/tambah-pertanyaan/{id}', 'MapelController@tambahPertanyaanMapel')
                ->name('tambahPertanyaanMapel');
            Route::post('/admin/mapel/insert-pertanyaan', 'MapelController@insertPertanyaanMapel')
                ->name('insertPertanyaanMapel');

            // Pertanyaan
            Route::get('/admin/pertanyaan', 'PertanyaanController@index')
                ->name('pertanyaan');
            Route::get('/admin/pertanyaan/create', 'PertanyaanController@create')
                ->name('pertanyaanCreate');
            Route::post('/admin/pertanyaan/tambah', 'PertanyaanController@tambahPertanyaan')
                ->name('tambahPertanyaan');
            Route::post('/admin/pertanyaan/upload', 'PertanyaanController@uploadImage')
                ->name('uploadImage');
            Route::get('/admin/pertanyaan/edit/{id}', 'PertanyaanController@editPertanyaan')
                ->name('editPertanyaan');
            Route::put('/admin/pertanyaan/update', 'PertanyaanController@updatePertanyaan')
                ->name('updatePertanyaan');
            Route::get('/admin/pertanyaan/delete/{id}', 'PertanyaanController@delete')
                ->name('deletePertanyaan');
            Route::get('/admin/pertanyaan/tambah-jawaban/{id}', 'PertanyaanController@tambahJawabanPertanyaan')
                ->name('tambahJawabanPertanyaan');
            Route::post('/admin/pertanyaan/insert-jawaban', 'PertanyaanController@insertJawabanPertanyaan')
                ->name('insertJawabanPertanyaan');

            // Jawaban
            Route::get('/admin/jawaban', 'JawabanController@index')
                ->name('jawaban');
            Route::get('/admin/jawaban/create', 'JawabanController@createJawaban')
                ->name('createJawaban');
            Route::post('/admin/jawaban/tambah', 'JawabanController@tambahJawaban')
                ->name('tambahJawaban');
            Route::get('/admin/jawaban/edit/{id}', 'JawabanController@editJawaban')
                ->name('editJawaban');
            Route::put('/admin/jawaban/update', 'JawabanController@updateJawaban')
                ->name('updateJawaban');
            Route::get('/admin/jawaban/delete/{id}', 'JawabanController@delete')
                ->name('deleteJawaban');

            // Penilaian
            Route::get('/admin/penilaian', 'PenilaianController@index')
                ->name('penilaian');
            Route::post('/admin/penilaian/tambah', 'PenilaianController@tambahPenilaian')
                ->name('tambahPenilaian');
            Route::get('/admin/penilaian/{id}', 'PenilaianController@editPenilaian')
                ->name('editPenilaian');
            Route::post('/admin/penilaian/update', 'PenilaianController@updatePenilaian')
                ->name('updatePenilaian');
            Route::get('/admin/penilaian/delete/{id}', 'PenilaianController@deletePenilaian')
                ->name('deletePenilaian');
        });
    });


// Client Side
Route::group(['namespace' => 'Auth'], function () {
    // Logout User
    Route::post('/client/logout', 'LoginController@logoutUser')
        ->name('logoutUser');

    // Email verification for users
    Route::get('email/verify', 'VerificationController@show')
        ->name('verification.notice');
    Route::get('email/verify/{id}', 'VerificationController@verify')
        ->name('verification.verify');
    Route::get('email/resend', 'VerificationController@resend')
        ->name('verification.resend');

    // Authentication Routes...
    Route::get('login', 'LoginController@showLoginForm')
        ->name('login');
    Route::post('login', 'LoginController@login');
    // Route::post('logout', 'LoginController@logout')
        // ->name('logout');

    // Registration Routes...
    Route::get('register', 'RegisterController@showRegistrationForm')
        ->name('register');
    Route::post('register', 'RegisterController@register');
    // Route::post('register', 'RegisterController@create')
    Route::post('getKabupatenKota', 'RegisterController@getKabupatenKota')
        ->name('getKabupatenKota');

    // Password Reset Routes...
    Route::get('password/reset', 'ForgotPasswordController@showLinkRequestForm')
        ->name('password.request');
    Route::post('password/email', 'ForgotPasswordController@sendResetLinkEmail')
        ->name('password.email');
    Route::get('password/reset/{token}', 'ResetPasswordController@showResetForm')
        ->name('password.reset');
    Route::post('password/reset', 'ResetPasswordController@reset');
});

Route::name('client.')
    ->group(function () {
        Route::group(['namespace' => 'Auth'], function () {
        });

        Route::group(['namespace' => 'Client', 'middleware' => ['auth:web', 'verified']], function () {
            Route::get('/client-dashboard', 'ClientController@index')
                ->name('index');
        });
    });
