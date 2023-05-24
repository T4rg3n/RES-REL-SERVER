<?php

namespace App\Http\Controllers\V1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\V1\LoginRequest;
use App\Mail\RegistrationMail;
use Illuminate\Support\Facades\Hash;
use App\Models\Utilisateur;
use App\Services\V1\TokenAttributor;
use Illuminate\Support\Facades\Mail;

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

        $token = (new TokenAttributor())->createToken($user);

        Mail::to('vic.gombert@gmail.com')->send(new RegistrationMail());

        return response()->json([
            'idUti' => $user->id_uti,
            'token' => $token
        ], 200);

    }
}
