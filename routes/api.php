<?php

use App\Http\Controllers\EtudiantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('/parse/etudiant')->name('admin.etudiant.')->group(function () {
    Route::get('/', 'EtudiantController@index')->name('index');
    Route::get('/create', 'EtudiantController@create')->name('create');
    Route::post('/', 'EtudiantController@store')->name('store');
    Route::get('/search/{NomEtudiant}', 'EtudiantController@search')->name('search');
    Route::get('/show/{etudiant}', 'EtudiantController@show')->name('show');
    Route::get('/edit/{etudiant}', 'EtudiantController@edit')->name('edit');
    Route::put('/{etudiant}', 'EtudiantController@update')->name('update');
    Route::delete('/{etudiant}', 'EtudiantController@delete')->name('destroy');
});