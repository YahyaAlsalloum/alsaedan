<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
//        $this->redirectTo = abort(404);
        $this->middleware('guest')->except('logout');
    }

    public function username()
    {
        return 'email';
    }


    protected function authenticated(Request $request, $user)
    {

        $roles_ids = Role::query()->whereIn('slug', ['admin','dev'])->get()->pluck('_id');
        $userRoleId = Role::query()->where('slug' ,'user')->first();
        if (in_array($user->role->_id, $roles_ids->toArray() ) ) {
            $this->redirectTo = '/cms';
        }elseif($user->role->_id == $userRoleId->_id){
           abort(403);
        }
    }

}
