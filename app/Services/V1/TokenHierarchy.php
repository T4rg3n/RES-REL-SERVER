<?php

namespace App\Services\V1;

use App\Models\Role;
use App\Models\Utilisateur;
use Illuminate\Support\Facades\DB;

class TokenHierarchy
{
    /**
     * Check if a role is superior to another
     *
     * @param int $id_role
     * @param int $id_utilisateur
     * @return bool
     */
    public function isSuperior($id_role, $id_utilisateur)
    {
        $role = Role::find($id_role);
        $utilisateur = Utilisateur::find($id_utilisateur);

        if($utilisateur == null) {
            return response()->json([
                'message' => 'Utilisateur not found'
            ], 404);
        }

        if($role == null) {
            return response()->json([
                'message' => 'Role not found'
            ], 404);
        }

        $utilisateur = Utilisateur::find($id_utilisateur);
        //$idRoleUtilisateur = Role::where('id_role', $utilisateur->role_id)->first();

        $roleUtilisateur = Role::find($utilisateur->role_id);
        $requestedRole = Role::find($id_role);

        if(Role::where('id_role', '=', $utilisateur->role_id)->where('ascendant_role', '=', $requestedRole)) {
            return true;
        } else {
            return false;
        }
    }
}
