<?php

use App\Http\Controllers\V1\CategorieController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| These routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group.
|
*/

// authenticated routes
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1', 'middleware' => 'auth:sanctum'], function () {
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
    Route::post('login', 'LoginController@login');

    //PUT / PATCH / DELETE
        //only/except: index, create, store, show, edit, update, destroy
    Route::apiResource('categories', CategorieController::class)->except(['index', 'show']);
    Route::apiResource('commentaires', CommentaireController::class)->except(['index', 'show']);
    Route::apiResource('favoris', FavorisController::class);
    Route::apiResource('groupes', GroupeController::class)->except(['index', 'show']);
    Route::apiResource('piecesJointes', PieceJointeController::class)->except(['index', 'show']);
    Route::apiResource('relations', RelationController::class);
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class)->except(['index', 'show']);
    Route::apiResource('ressources', RessourceController::class)->except(['index', 'show']);
    Route::apiResource('roles', RoleController::class)->except(['index', 'show']);
    Route::apiResource('typesRelation', TypeRelationController::class)->except(['index', 'show']);
    Route::apiResource('utilisateurs', UtilisateurController::class)->except(['index', 'show']);
});

// public routes (no favorites or relations, only authenticated users)
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    //POST
    Route::post('search', 'SearchController@search');
   
    //GET / HEAD
    Route::apiResource('categories', CategorieController::class)->only(['index', 'show']);
    Route::apiResource('commentaires', CommentaireController::class)->only(['index', 'show']);
    Route::apiResource('groupes', GroupeController::class)->only(['index', 'show']);
    Route::apiResource('piecesJointes', PieceJointeController::class)->only(['index', 'show']);
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class)->only(['index', 'show']);
    Route::apiResource('ressources', RessourceController::class)->only(['index', 'show']);
    Route::apiResource('roles', RoleController::class)->only(['index', 'show']);
    Route::apiResource('typesRelation', TypeRelationController::class)->only(['index', 'show']);
    Route::apiResource('utilisateurs', UtilisateurController::class)->only(['index', 'show']);
});