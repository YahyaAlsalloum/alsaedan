<?php
namespace App\Utils\Passport;

use App\Utils\Passport\Token;
use Carbon\Carbon;
use Illuminate\Container\Container;
use Illuminate\Support\Str;
use Laravel\Passport\PersonalAccessTokenFactory;

trait HasApiTokens
{

    protected $accessToken;


    public function clients()
    {
        return $this->belongsToMany(Token::class, 'oauth_access_tokens','user_id');
    }

    public function tokens()
    {
        return $this->belongsToMany(Token::class, 'oauth_access_tokens','user_id')->orderBy('created_at', 'desc');
    }

    public function token()
    {
        return $this->accessToken;
    }

    public function tokenCan($scope)
    {
        return $this->accessToken ? $this->accessToken->can($scope) : false;
    }


    public function createToken()
    {
        $token = new Token();
        $token->user_id = $this->getKey();
        $token->access_token = Str::random(1000);
        $token->refresh_token = Str::random(1000);
        $token->expires_in = Carbon::now()->addDays(365)->toDateTimeString();
        $token->save();

        return $token;

    }

    public function withAccessToken($accessToken)
    {
        $this->accessToken = $accessToken;

        return $this;
    }
}
