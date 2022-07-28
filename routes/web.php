<?php

use Illuminate\Support\Facades\Route;

$router->get('/', function () {
    return env('APP_NAME');
});

Route::post('/login', 'AuthController@login');

Route::group(['middleware' => 'auth:api'], function () {
    Route::group(['prefix' => 'perawat'], function () {
        Route::get('/', 'UserController@index');
        Route::post('/', 'UserController@store');
        Route::get('/{id}', 'UserController@show');
        Route::put('/{id}', 'UserController@update');
        Route::delete('/{id}', 'UserController@destroy');
    });

    Route::group(['prefix' => 'pasien'], function () {
        Route::get('/', 'PasienController@index');
        Route::post('/', 'PasienController@store');
        Route::get('/{id}', 'PasienController@show');
        Route::put('/{id}', 'PasienController@update');
        Route::delete('/{id}', 'PasienController@destroy');
        Route::get('/filter/nip', 'PasienController@getByIdPerawat');
    });

    Route::group(['prefix' => 'bbp'], function () {
        Route::get('/', 'BukuBantuPerawatController@index');
        Route::get('/tugas/{kd_jabatan}', 'BukuBantuPerawatController@tugas');
        Route::get('/kegiatan/{id_tugas}', 'BukuBantuPerawatController@kegiatan');
    });

    Route::group(['prefix' => 'kinerja'], function () {
        Route::get('/', 'ReportKinerjaPerawatController@index');
        Route::post('/', 'ReportKinerjaPerawatController@store');
        Route::put('/{id}', 'ReportKinerjaPerawatController@update');
        Route::get('/{nip}', 'ReportKinerjaPerawatController@getByNip');
        Route::get('/jabatan/{kd_jabatan}', 'ReportKinerjaPerawatController@getByKdJabatan');
        Route::post('/delete', 'ReportKinerjaPerawatController@destroy');
    });

    Route::group(['prefix' => 'referensi'], function () {
        Route::get('/jabatan', 'ReferensiController@jabatan');
    });

    Route::group(['prefix' => 'log'], function () {
        Route::get('/', 'LogActionController@index');
        Route::get('/{id}', 'LogActionController@showByUserId');
        Route::post('/date', 'LogActionController@showByDate');
    });

    Route::get('/area-pelayanan', 'AreaPelayananController@index');
    Route::get('/area-pelayanan/{id}', 'AreaPelayananController@showSubArea');

    Route::post('/change-pass', 'UserController@passwordChange');

    Route::get('/me', 'AuthController@me');
    Route::post('/logout', 'AuthController@logout');
});
