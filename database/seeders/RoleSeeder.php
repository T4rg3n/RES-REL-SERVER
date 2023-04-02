<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       $roles = [
            'super-admin',
            'admin', 
            'moderateur', 
            'utilisateur',
        ];

        $ascendants = [
            'super-admin' => null,
            'admin' => 'super-admin',
            'moderateur' => 'admin',
            'utilisateur' => 'moderateur'
        ];

        $descendants = [
            'super-admin' => 'admin',
            'admin' => 'moderateur',
            'moderateur' => 'utilisateur',
            'utilisateur' => 'auth'
        ];

        foreach($roles as $role){
            DB::table((new Role())->getTable())->insert([
                'nom_role' => $role,
                'ascendant_role' => $ascendants[$role],
                'descendant_role' => $descendants[$role]
            ]);
        }
    }
}
