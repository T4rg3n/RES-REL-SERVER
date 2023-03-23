<?php

use App\Http\Controllers\V1\CategorieController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// api/v1
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {

    //Protected routes

    //PATCH 
        //(Disable)
        Route::patch('utilisateurs/disable', 'UtilisateurController@disable');
        Route::patch('ressources/disable', 'RessourceController@disable');
        Route::patch('commentaires/{id}/disable', 'CommentaireController@disable');
        Route::patch('reponsesCommentaires/{id}/disable', 'ReponseCommentaireController@disable');
        //(Report)
        Route::patch('commentaires/{id}/report', 'CommentaireController@report');
        Route::patch('reponsesCommentaires/{id}/report', 'ReponseCommentaireController@report');
        //(Like) (unlike is a DELETE)
        Route::patch('ressources/like', 'FavorisController@like');
        //Enable (Accept a pending resource)
        Route::patch('ressources/{id}/enable', 'RessourceController@enable');    
    //POST    
        //(POST)
    Route::post('login', 'LoginController@login');
    
    //Public routes
    //Search (POST)
    Route::post('search', 'SearchController@search');
    
    //GET / HEAD / POST / PUT / PATCH / DELETE
    Route::apiResource('categories', CategorieController::class)->except(['get', 'head'])->middleware('auth');
    Route::apiResource('commentaires', CommentaireController::class)->middleware('auth');
    Route::apiResource('favoris', FavorisController::class);
    Route::apiResource('groupes', GroupeController::class);
    Route::apiResource('piecesJointes', PieceJointeController::class);
    Route::apiResource('relations', RelationController::class);
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class);
    Route::apiResource('ressources', RessourceController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('typesRelation', TypeRelationController::class);
    Route::apiResource('utilisateurs', UtilisateurController::class);
});