<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\StoreUtilisateurRequest;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class LoginController extends Controller
{
    /**
     * Login a user and get a bearer token
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //check if user exists in database
        $user = Utilisateur::where('mail_uti', $request->mail)->first();
        if(!$user || !Hash::check($request->motDePasse, $user->mdp_uti)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $credentials = $request->validate([
            'mail' => ['required', 'email'], 
            'motDePasse' => ['required']
        ]);

        //TODO translate mail & motDePasse to 'mail_uti' and 'mdp_uti'

        if (Auth::attempt($credentials)) {
            $user = Auth::utilisateur();

            //TODO issue tokens depending on typeCompte
            $token = $user->createToken('authToken')->accessToken;

            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }
    }
}
