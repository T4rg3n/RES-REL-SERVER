<?php 

namespace App\Services\V1;

class TokenAttributor
{
    /**
     * Create a token for a user
     * 
     * @param \App\Models\Utilisateur $user
     * @return \Illuminate\Http\JsonResponse
     */
    public function createToken($user, $expiresAt = null)
    {
        switch($user->role->nom_role) {
            case 'super-admin':
                $token = $user->createToken('superAdminToken', ['super-admin'], $expiresAt);
                break;
            case 'admin':
                $token = $user->createToken('adminToken', ['admin'], $expiresAt);
                break;
            case 'moderateur':
                $token = $user->createToken('moderatorToken', ['moderateur'], $expiresAt);
                break;
            case 'utilisateur':
                $token = $user->createToken('userToken', ['utilisateur'], $expiresAt);
                break;
            default:
                $token = $user->createToken('authToken', ['auth'], $expiresAt);
        }

        return $token->plainTextToken;
    }
}