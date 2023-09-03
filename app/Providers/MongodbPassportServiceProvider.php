<?php

namespace App\Providers;

use App\Utils\Passport\AuthCode;
use App\Utils\Passport\Bridge\RefreshTokenRepository;
use App\Utils\Passport\Client;
use App\Utils\Passport\PersonalAccessClient;
use App\Utils\Passport\Token;
use Illuminate\Support\ServiceProvider;
use Laravel\Passport\Bridge\RefreshTokenRepository as PassportRefreshTokenRepository;
use Laravel\Passport\Passport;
use Laravel\Passport\TokenRepository;

class MongodbPassportServiceProvider extends ServiceProvider
{
    /**
     * @return void
     */
    public function register()
    {
        Passport::useAuthCodeModel(AuthCode::class);
        Passport::useClientModel(Client::class);
        Passport::usePersonalAccessClientModel(PersonalAccessClient::class);
        Passport::useTokenModel(Token::class);

        $this->app->bind(PassportRefreshTokenRepository::class, function () {
            return $this->app->make(RefreshTokenRepository::class);
        });

    }
}
