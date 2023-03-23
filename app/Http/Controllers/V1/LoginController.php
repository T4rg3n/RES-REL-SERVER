<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
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
    public function login(LoginRequest $request)
    {
        $user = Utilisateur::where('mail_uti', $request->mail)->first();
        if(!$user) {
            return response()->json([
                'message' => 'User not found'
            ], 401);
        }

        if(!Hash::check($request->motDePasse, $user->mdp_uti)) {
            return response()->json([
                'message' => 'Invalid credentials!'
            ], 401);
        }

        switch($user->role->nom_role) {
            case 'super-admin':
                $token = $user->createToken('authToken', ['super-admin']);
                break;
            case 'admin':
                $token = $user->createToken('authToken', ['admin']);
                break;
            case 'moderateur':
                $token = $user->createToken('authToken', ['moderateur']);
                break;
            case 'utilisateur':
                $token = $user->createToken('authToken', ['utilisateur']);
                break;
            default:
                $token = $user->createToken('authToken');
        }

        return response()->json([
            'user' => $user,
            'token' => $token->plainTextToken
        ], 200);

    }
}