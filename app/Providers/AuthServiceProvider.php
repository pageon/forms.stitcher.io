<?php

namespace App\Providers;

use App\Services\Auth\Guard;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

        Auth::extend('web_active', function ($app, $name, array $config) {
            return new Guard(
                $name,
                Auth::createUserProvider($config['provider']),
                app(Session::class),
                app(Request::class)
            );
        });
    }
}
