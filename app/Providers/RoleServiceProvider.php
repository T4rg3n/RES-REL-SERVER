<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Log;
use App\Models\Utilisateur;

class StatisticsServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
    
        Gate::define('isSuperAdmin', function ($userId) {

            $user = Utilisateur::find($userId);
            return $user->role->nom_role == 'super-admin';
        });

        Gate::define('isAdmin', function ($userId) {

            $user = Utilisateur::find($userId);
            return $user->role->nom_role == 'admin';
        });

        Gate::define('isModerator', function ($userId) {

            $user = Utilisateur::find($userId);
            return $user->role->nom_role == 'moderateur';
        });

        Gate::define('isUser', function ($userId) {

            $user = Utilisateur::find($userId);
            return $user->role->nom_role == 'utilisateur';
        });
    }
}
