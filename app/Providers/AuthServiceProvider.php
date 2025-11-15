<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('admin', function ($user) {
            return $user->role === "admin";
        });

        Gate::define('employer', function ($user) {
            return $user->role === "employer";
        });

        Gate::define('candidate', function ($user) {
            return $user->role === "candidate";
        });

        Gate::define('adminoremployer', function ($user) {
            return ($user->role === "admin") || ($user->role === "employer");
        });
        
    }
}