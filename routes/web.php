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

Route::get('/', function () {
    return redirect()->route('admin.admin.index');
});

Route::get('/home', function () {
    return redirect()->route('admin.admin.index');
});

/**
 * admin page route
 */
Route::group(
    [
        'prefix' => 'admin'
    ], function () {

    Route::get('/', 'Admin\AdminBaseController@index')
        ->name('admin.admin.index');

    Route::post('/login', 'Admin\AdminBaseController@login')
        ->name('admin.admin.login');

    Route::group(
        [
            'prefix' => 'customer'
        ], function () {

        Route::any('/', 'Admin\CustomerController@index')
            ->name('admin.customer.index');
        Route::post('/save', 'Admin\CustomerController@save')
            ->name('admin.customer.save');
    });

    Route::group(
        [
            'prefix' => 'production'
        ], function () {

        Route::any('/', 'Admin\ProductionController@index')
            ->name('admin.production.index');
        Route::post('/save', 'Admin\ProductionController@save')
            ->name('admin.production.save');
        Route::post('/detail', 'Admin\ProductionController@detail')
            ->name('admin.production.detail');
    });
});
