<?php

use App\Http\Controllers\EtudiantController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// Route permettant de récupérer toutes les étudiants
Route::get('/parse/etudiant', 'EtudiantController@index');

// Route permettant d'ajouter un nouveau étudiant
Route::post('/parse/etudiant', 'EtudiantController@store');

// Route permettant de récupérer un étudiant
Route::get('/parse/etudiant/{IdEtudiant}', 'EtudiantController@show');

// Route permettant de modifier un étudiant
Route::put('/parse/etudiant/{IdEtudiant}', 'EtudiantController@update');
