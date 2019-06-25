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
    return view('welcome');
});

Auth::routes();

Route::middleware('auth')->group(function() {
    Route::name('admin.')->group(function() {
        Route::get('/', 'HomeController@index')->name('home');

        /**
         * Equipment type resource
         */
        Route::resource('equipments/types', 'EquipmentTypeController');
        // Route::get('equipments/types', 'EquipmentTypeController@index')->name('equipments.type.index');
        // Route::get('equipments/types/create', 'EquipmentTypeController@create')->name('equipments.type.create');

        /**
         * Equipment resource
         */
        // Route::get('equipments/trashed', 'EquipmentController@trashed')->name('equipments.trashed');
        Route::post('equipments/{equipment}', 'EquipmentController@restore')->name('equipments.restore');
        Route::resource('equipments', 'EquipmentController');
        Route::delete('equipments/{equipment}/delete', 'EquipmentController@destroy')->name('equipments.destroy');
        Route::delete('equipments/{equipment}', 'EquipmentController@trash')->name('equipments.trash');

    });
});