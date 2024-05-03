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

// Route permettant de récupérer les étudiant à recherche
Route::get('/parse/etudiant/{NomEtudiant}', 'EtudiantController@search');

// Route permettant de récupérer un étudiant
Route::get('/parse/etudiant/{IdEtudiant}', 'EtudiantController@show');

// Route permettant de modifier un étudiant
Route::put('/parse/etudiant/{IdEtudiant}', 'EtudiantController@update');

// Route permettant de modifier un étudiant
Route::delete('/parse/etudiant/{IdEtudiant}', 'EtudiantController@delete');

/** ========================================= POST ============================= */
// Route permettant de récupérer toutes les étudiants
Route::get('/parse/post', 'PostController@index');

// Route permettant d'ajouter un nouveau étudiant
Route::post('/parse/post', 'PostController@store');

// Route permettant de récupérer les étudiant à recherche
Route::get('/parse/post/{title}', 'PostController@search');

// Route permettant de récupérer un étudiant
Route::get('/parse/post/{PostId}', 'PostController@show');

// Route permettant de modifier un étudiant
Route::put('/parse/post/{PostId}', 'PostController@update');

// Route permettant de modifier un étudiant
Route::delete('/parse/post/{PostId}', 'PostController@delete');

/** ========================================= COMMENT ============================= */
// Route permettant de récupérer toutes les comments
Route::get('/parse/comment', 'CommentController@index');

// Route permettant d'ajouter un nouveau comment
Route::post('/parse/comment/{postId}', 'CommentController@store');

// // Route permettant de récupérer le ou les comments à recherche
// Route::get('/parse/comment/{title}', 'PostController@search');

// // Route permettant de récupérer un comment
// Route::get('/parse/comment/{PostId}', 'PostController@show');

// // Route permettant de modifier un comment
// Route::put('/parse/comment/{PostId}', 'PostController@update');

// // Route permettant de modifier un comment
// Route::delete('/parse/comment/{PostId}', 'PostController@delete');