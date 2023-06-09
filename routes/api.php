<?php

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
        Route::patch('commentaires/{id}/report', 'CommentaireController@report');
        Route::patch('reponsesCommentaires/{id}/disable', 'ReponseCommentaireController@disable');
        //(Report)
        Route::patch('commentaires/{id}/report', 'CommentaireController@report');
        Route::patch('reponsesCommentaires/{id}/report', 'ReponseCommentaireController@report');
        //(Like) (unlike is a DELETE)
        Route::patch('ressources/like', 'FavorisController@like');
        //Enable (Accept a pending resource)
        Route::patch('ressources/{id}/enable', 'RessourceController@enable');    
        //Demote 
        Route::patch('retrograder', 'DemoteController@patch');
        //Promote
        Route::patch('promouvoir', 'PromoteController@patch');
        //Accepter une relation
        Route::patch('relations/{id}/accepter', 'RelationController@accept');
        //Refuser une relation
        Route::patch('relations/{id}/refuser', 'RelationController@refuse');

    //PUT / PATCH / DELETE
        //only/except: index, create, store, show, edit, update, destroy
    Route::apiResource('categories', CategorieController::class)->except(['index', 'show']);
    Route::apiResource('commentaires', CommentaireController::class)->except(['index', 'show']);
    Route::apiResource('favoris', FavorisController::class)->except(['index', 'show']);
    Route::apiResource('groupes', GroupeController::class)->except(['index', 'show']);
    Route::apiResource('piecesJointes', PieceJointeController::class)->except(['index', 'show']);
    Route::apiResource('relations', RelationController::class)->except(['index', 'show']);
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class)->except(['index', 'show']);
    Route::apiResource('ressources', RessourceController::class)->except(['index', 'show']);
    Route::apiResource('roles', RoleController::class)->except(['index', 'show']);
    Route::apiResource('typesRelation', TypeRelationController::class)->except(['index', 'show']);
    Route::apiResource('utilisateurs', UtilisateurController::class)->except(['index', 'show']);
    Route::apiResource('marquePages', BookmarkController::class)->except(['index', 'show']);
    
    Route::get('deconnexion', 'UtilisateurController@logout');
});

// public routes (no favorites or relations)
Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\V1'], function () {
    //POST
    Route::post('rechercher', 'SearchController@rechercher');
    Route::post('connexion', 'LoginController@login');
    Route::post('inscription', 'UtilisateurController@store');
    
    //GET / HEAD
    Route::apiResource('favoris', FavorisController::class)->only(['index', 'show']);
    Route::apiResource('relations', RelationController::class)->only(['index', 'show']);
    Route::apiResource('groupes', GroupeController::class)->only(['index', 'show']);
    Route::apiResource('categories', CategorieController::class)->only(['index', 'show']);
    Route::apiResource('commentaires', CommentaireController::class)->only(['index', 'show']);
    Route::apiResource('piecesJointes', PieceJointeController::class)->only(['index', 'show']);
    Route::apiResource('marquePages', BookmarkController::class)->only(['index', 'show']);
        //to download file attachement
        Route::get('piecesJointes/{id}/download', 'PieceJointeController@download');
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class)->only(['index', 'show']);
    Route::apiResource('ressources', RessourceController::class)->only(['index', 'show']);
    Route::apiResource('roles', RoleController::class)->only(['index', 'show']);
    Route::apiResource('typesRelation', TypeRelationController::class)->only(['index', 'show']);
    //GET / HEAD / POST
    Route::apiResource('utilisateurs', UtilisateurController::class)->only(['index', 'show']);
        Route::get('utilisateurs/{id}/download', 'UtilisateurController@download');
});