<?php

use Illuminate\Support\Facades\Route;


Route::prefix('/subjects')->group(function () {
    Route::get('/', 'App\Http\Controllers\SubjectController@index')->name('subjects.index');
    Route::get('/{id}', 'App\Http\Controllers\SubjectController@show')->name('subjects.show');
    Route::post('/', 'App\Http\Controllers\SubjectController@store')->name('subjects.store');
});
