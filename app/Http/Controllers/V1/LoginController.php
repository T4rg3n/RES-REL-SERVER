<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use App\Services\V1\TokenAttributor;

class LoginController extends Controller
{
    /**
     * Login a user and get a bearer token
     *
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function login(LoginRequest $request)
    {
        $user = Utilisateur::where('mail_uti', $request->mail)->first();

        if(!Hash::check($request->motDePasse, $user->mdp_uti)) {
            return response()->json([
                'message' => 'Invalid credentials!'
            ], 401);
        }

        $token = (new TokenAttributor())->createToken($user);

        return response()->json([
            'idUti' => $user->id_uti,
            'token' => $token
        ], 200);
    }
}
