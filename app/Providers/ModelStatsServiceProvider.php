<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Jhumanj\LaravelModelStats\LaravelModelStats;
use Jhumanj\LaravelModelStats\ModelStatsServiceProvider as Provider;
use Laravel\Sanctum\PersonalAccessToken;
use Illuminate\Support\Facades\Log;

class ModelStatsServiceProvider extends Provider
{
    /**
     * Register the LaravelModelStats gate.
     *
     * This gate determines who can access ModelStats in non-local environments.
     *
     * @return void
     */
    protected function gate(): void
    {
        Gate::define('viewModelStats', function ($user = null) {
            if ($user && $user->role->nom_role == 'admin' || $user->role->nom_role == 'super-admin') {
                return true;
            }

            return false;
        });
    }
}
