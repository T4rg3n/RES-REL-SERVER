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
        Gate::define('viewModelStats', function ($user) {

            $request = request();
            $token = $request->bearerToken();

            //check if token is valid
            if (empty($token)) {
                return false;
            }

            //get user from token
            $token = PersonalAccessToken::findToken($token);
            return $token->tokenable->id == $user->id;
            Log::debug("User: " . $user->id . " Token: " . $token->tokenable->id);


            // return in_array($user->email, [
            //     //
            // ]);
        });
    }
}
