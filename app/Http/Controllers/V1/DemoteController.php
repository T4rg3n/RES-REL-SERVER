<?php

namespace App\Http\Controllers\V1;

use App\Http\Controllers\Controller;
use App\Models\Utilisateur;
use Illuminate\Http\Request;
use App\Models\Role;
use App\Services\V1\TokenAttributor;

class DemoteController extends Controller
{
    /**
     * Edit the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     */
    public function patch(Request $request)
    {
        //TODO refactor
        // $this->validate($request, [
        //     'idUtilisateur' => 'required|integer',
        //     'idRole' => 'required|integer',
        // ]);

        // if((new TokenHierarchy())->isSuperior($request->idRole, $request->idUtilisateur)) {
        //     return response()->json([
        //         'message' => 'Unauthorized (isSuperior)'
        //     ], 403);
        // }

        // $utilisateur = Utilisateur::find($request->idUtilisateur);

        // if(!$utilisateur->tokenCan(['admin', 'super-admin'])) {
        //     return response()->json([
        //         'message' => 'Unauthorized (tokenCan)'
        //     ], 403);
        // }

        // $role = Role::find($request->idRole);
        // /*
        //         if($utilisateur == null || $role == null) {
        //             return response()->json([
        //                 'message' => 'Utilisateur introuvable'
        //             ], 404);
        //         }
        // */
        // $utilisateur->role_id = $role->id;
        // $utilisateur->save();

        // $utilisateur->currentAccessToken()->delete();
        // $token = (new TokenAttributor())->createToken($utilisateur);

        // return response()->json([
        //     'message' => 'Utilisateur demoted',
        //     'newToken' => $token
        // ], 200);
    }
}
