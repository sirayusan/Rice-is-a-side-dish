<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use Auth;

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

        //
    }

    public function register() {

    //UserServiceProviderから受け取った値でAuth::user()を更新する
		Auth::provider('auth_ex', function($app) {
			// スタックオーバーフロー先生はこれで取れると書いてあるんだけど、モデルが取れない…
			// $model = $this->app['config']['auth.model'];
			$model = $app['config']['auth.providers.users.model'];
			return new AuthUserProvider($app['hash'], $model);
		});

	}

}
