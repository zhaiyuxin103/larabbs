<?php

namespace App\Providers;

use App\Models\Team;
use App\Policies\TeamPolicy;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Laravel\Passport\AuthCode;
use Laravel\Passport\Client;
use Laravel\Passport\Passport;
use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\Token;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        Team::class => TeamPolicy::class,
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot(): void
    {
        $this->registerPolicies();

        Passport::ignoreRoutes();
        Passport::useTokenModel(Token::class);
        Passport::useClientModel(Client::class);
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        // access_token 过期时间
        Passport::tokensExpireIn(now()->addDays(15));
        // refresh_token 过期时间
        Passport::refreshTokensExpireIn(now()->addDays(30));
        Passport::personalAccessTokensExpireIn(now()->addMonths(6));
    }
}
