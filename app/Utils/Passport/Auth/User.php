<?php

namespace App\Utils\Passport\Auth;

use App\Utils\Passport\PersonalAccessTokenFactory;
use Illuminate\Auth\Authenticatable;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Container\Container;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Illuminate\Foundation\Auth\Access\Authorizable;
use Jenssegers\Mongodb\Eloquent\Model;

class User extends Model implements
    AuthenticatableContract,
    AuthorizableContract,
    CanResetPasswordContract
{
    use Authenticatable, Authorizable, CanResetPassword;


    // public function createToken($name, array $scopes = [])
    // {
    //     return Container::getInstance()->make(PersonalAccessTokenFactory::class)->make(
    //         $this->getKey(), $name, $scopes
    //     );
    // }
}
