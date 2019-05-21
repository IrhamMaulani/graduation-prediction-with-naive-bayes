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

 Route::prefix('admin')->group(function () {
     Route::prefix('data-training')->group(function () {
         Route::get('/', 'DataTrainingController@index');
         Route::get('/to-json', 'DataTrainingController@toJson');
         Route::delete('/{id}', 'DataTrainingController@destroy');
         Route::post('/import', 'DataTrainingController@import')->name('data-training-import');
     });

     Route::get('/data-testing', 'DataTestingController@index');
 });
