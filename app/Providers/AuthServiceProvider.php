<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        // 'App\Models\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();
        //Superuser Spatie.
        //https://spatie.be/docs/laravel-permission/v5/basic-usage/super-admin
        Gate::before(function($user, $ability) {
            return $user->email == 'sonder672@hotmail.com' ?? null;
        });
        //
    }
}
