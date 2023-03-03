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
    //PATCH 
        //(Disable)
    Route::patch('utilisateurs/disable', 'UtilisateurController@disable');
    Route::patch('ressources/disable', 'RessourceController@disable');
    Route::patch('commentaire/disable', 'CommentaireController@disable');
    Route::patch('reponsesCommentaire/disable', 'ReponseCommentaireController@disable');
        //(Report)
    Route::patch('commentaire/{id}/report', 'CommentaireController@report');
    Route::patch('reponseCommentaire/{id}/report', 'ReponseCommentaireController@report');
        //(Like)
    //TODO les likes

    //GET/HEAD/POST
    Route::apiResource('categories', CategorieController::class);
    Route::apiResource('commentaires', CommentaireController::class);
    Route::apiResource('favoris', FavorisController::class);
    Route::apiResource('groupes', GroupeController::class);
    Route::apiResource('piecesJointes', PieceJointeController::class);
    Route::apiResource('relations', RelationController::class);
    Route::apiResource('reponsesCommentaires', ReponseCommentaireController::class);
    Route::apiResource('ressources', RessourceController::class);
    Route::apiResource('roles', RoleController::class);
    Route::apiResource('typesRelation', TypeRelationController::class);
    Route::apiResource('utilisateurs', UtilisateurController::class);

    //DELETE
    Route::delete('categories', 'CategorieController@destroy');
    Route::delete('commentaires', 'CommentaireController@destroy');
    Route::delete('favoris', 'FavorisController@destroy');
    Route::delete('groupes', 'GroupeController@destroy');
    Route::delete('piecesJointes', 'PieceJointeController@destroy');
    Route::delete('relations', 'RelationController@destroy');
    Route::delete('reponsesCommentaires', 'ReponseCommentaireController@destroy');
    Route::delete('ressources', 'RessourceController@destroy');
    Route::delete('roles', 'RoleController@destroy');
    Route::delete('typesRelation', 'TypeRelationController@destroy');
    Route::delete('utilisateurs', 'UtilisateurController@destroy');

});