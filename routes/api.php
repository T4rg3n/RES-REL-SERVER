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
    
    //Super Admin
    Route::group(['middleware' => ['roles:super-admin']], function () {
        Route::apiResource('roles', RoleController::class);
        Route::apiResource('utilisateurs', UtilisateurController::class);
        Route::apiResource('typesRelation', TypeRelationController::class);
    });

    //Admin
    Route::group(['middleware' => ['roles:admin,super-admin']], function () {
        //Ressources
        Route::apiResource('categories', CategorieController::class)->except(['index', 'show']);

        //Promote & Demote (should be in UtilisateurController)
        // Route::patch('retrograder', 'DemoteController@patch');
        // Route::patch('promouvoir', 'PromoteController@patch');
    });

    //Moderator
    Route::group(['middleware' => ['roles:moderateur,admin,super-admin']], function () {
        //Enable (Accept a pending resource)
        Route::patch('ressources/{id}/enable', 'RessourceController@enable');

        //Disable (Ban)
        Route::patch('utilisateurs/disable', 'UtilisateurController@disable');
        Route::patch('ressources/disable', 'RessourceController@disable');
        Route::patch('commentaires/{id}/disable', 'CommentaireController@disable');
        Route::patch('reponsesCommentaires/{id}/disable', 'ReponseCommentaireController@disable');
    });

    //User
    Route::group(['middleware' => ['roles:utilisateur,moderateur,admin,super-admin']], function () {
        //Like (unlike is a DELETE)
        //only/except: index, create, store, show, edit, update, destroy
        Route::patch('ressources/like', 'FavorisController@like'); 
        Route::apiResource('favoris', FavorisController::class)->only(['store', 'destroy']);
    
        // Bookmark (unbookmark is a DELETE)
        Route::apiResource('marquePages', BookmarkController::class)->only(['index', 'store', 'destroy']);

        //Report
        Route::patch('commentaires/{id}/report', 'CommentaireController@report');
        Route::patch('commentaires/{id}/report', 'CommentaireController@report');
        Route::patch('reponsesCommentaires/{id}/report', 'ReponseCommentaireController@report');
     
        //Relations management
        Route::patch('relations/{id}/accepter', 'RelationController@accept');
        Route::patch('relations/{id}/refuser', 'RelationController@refuse');
        Route::apiResource('relations', RelationController::class)->except(['index', 'show']);
        
        //Comments management
        Route::apiResource('commentaires', CommentaireController::class)->except(['index', 'show']);
        Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class)->except(['index', 'show']);
        
        //Ressources management
        Route::apiResource('ressources', RessourceController::class)->except(['index', 'show']);
        Route::apiResource('piecesJointes', PieceJointeController::class)->except(['index', 'show']);
        
        //Groups (are not implemented yet)
        //Route::apiResource('groupes', GroupeController::class)->except(['index', 'show']);
    });

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
