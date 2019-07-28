<?php

namespace App\Providers;

use App\Hooze;
use App\Policies\SchoolPolicy;
use App\Policies\UserPolicy;
use App\Policies\HoozePolicy;
use App\School;
use App\User;
use function foo\func;

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
        School::class => SchoolPolicy::class,
        User::class => UserPolicy::class,
        Hooze::class => HoozePolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        Gate::define('isSuperuser', function ($user) {
            return $user->role_id == 1;
        });
        Gate::define('isSupevisor', function ($user) {
            return $user->role_id == 2;
        });
        Gate::define('isUser', function ($user) {
            return $user->role_id == 3;
        });

        //
    }
}
