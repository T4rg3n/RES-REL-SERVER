<?php

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
});