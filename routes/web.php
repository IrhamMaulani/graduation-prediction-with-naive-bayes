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
  Route::group([
        'middleware' => 'auth',
    ], function () {
        Route::prefix('admin')->group(function () {
            Route::prefix('data-training')->group(function () {
                Route::get('/', 'DataTrainingController@index')->name('data-training.index');
                Route::get('/to-json', 'DataTrainingController@toJson');
                Route::delete('/{id}', 'DataTrainingController@destroy');
                Route::post('/import', 'DataTrainingController@import')->name('data-training-import');
            });

            Route::prefix('akurasi')->group(function () {
                Route::get('/', 'TestingTrialController@index');
                Route::get('/to-json', 'TestingTrialController@toJson');
                Route::delete('/{id}', 'TestingTrialController@destroy');
            });


            Route::prefix('data-target')->group(function () {
                Route::get('/', 'DataTargetController@index');
                Route::post('/', 'DataTargetController@store');
                Route::delete('/{id}', 'DataTargetController@destroy');
                Route::get('/to-json', 'DataTargetController@toJson');
            });

     

            Route::prefix('data-testing')->group(function () {
                Route::get('/', 'DataTestingController@index')->name('data-testing.index');
                Route::post('/', 'DataTestingController@store')->name('data-testing-post');
                Route::get('/to-json/batch={batch}', 'DataTestingController@toJson');
                Route::delete('/{id}', 'DataTestingController@destroy');
                Route::post('/import', 'DataTestingController@import')->name('data-testing-import');
            });
        });
    });
Auth::routes();

Route::get('/', function () {
    return redirect()->route('login');
});


Route::get('/home', 'HomeController@index')->name('home');
