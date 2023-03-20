<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;

class LoginController extends Controller
{
    /**
     * Login a user
     * 
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(Request $request)
    {
        //check if user exists in database
        $user = Utilisateur::where('mail_uti', $request->mail)->first();
        if(!$user || !Hash::check($request->motDePasse, $user->mot_de_passe_uti)) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        $credentials = $request->validate([
            'mail' => ['required', 'email'], 
            'motDePasse' => ['required']
        ]);

        if (Auth::attempt($credentials)) {
            $user = Auth::user();
            //$token = $user->createToken('authToken')->accessToken;

            /*
            return response()->json([
                'user' => $user,
                'token' => $token
            ], 200);
        } else {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);*/
        }
    }
}
