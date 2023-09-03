<?php

namespace App\Http\Controllers\Front\Auth;

use App\Http\Controllers\Controller;
use App\Mail\EmailVerification;
use App\Models\Role;
use App\Models\Status;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Foundation\Auth\SendsPasswordResetEmails;


class AuthController extends Controller
{

    use SendsPasswordResetEmails;
    //

    public function sendResetEmail( Request $request ){
        return $this->sendResetLinkEmail($request);
    }
    // public function register( Request $request ){

    //     $params = $this->validate($request, [
    //         'username'=>'required',
    //         'email'=>'required|unique:users',
    //         'phone'=>'required|unique:users',
    //         'password' => 'required|confirmed|min:6',
    //         'dob'=>'required',
    //         'country_code'=>'required',
    //         'gender'=> 'required|string|in:male,female,others'
    //     ]);

    //     $params['role_id'] = Role::query()->where('name', 'User')->first()->id;

    //     $user = User::create($params);

    //     $user->email_verification_token = Str::random(32);
    //     $user->save();

    //     Mail::to($user->email)->send(new EmailVerification($user));

    //     return response(['user'=> $user], 200);

    // }

    public function register( Request $request ){

        $params = $this->validate($request, [
            'name'=>'required',
            'email'=>'required|unique:users',
            // 'phone'=>'required|unique:users',
            'password' => 'required|confirmed|min:6',
        ]);

        $params['role_id'] = Role::query()->where('slug', 'user')->first()->id;

        $user = User::create($params);

        $user->save();

        $user->email_verification_token = Str::random(32);
        $user->save();


        // try{
            Mail::to($user->email)->send(new EmailVerification($user));
        // }catch (\Exception $e){

        // }

        return view('layouts.frontend.home');


    }

    public function verify($token){

        $user = User::query()->where('email_verification_token',$token)->first();

        if($user == null ){

            return response(['message'=>__('api.user_not_found')], 442);

        }

        $user->update([

            'status_id'=> Status::query()->where('name','Active')->first()->_id,
            'email_verified' => 1,
            'email_verified_at' => Carbon::now(),
            'email_verification_token' => ''
        ]);

        // toastr(
        //     "Thank you for verifying your email address. We will reach out to you to validate your business.",
        //     'success','',['positionClass'=>'toast-bottom-left',"closeButton"=> true,"timeOut"=> 15000]
        // );

        // return redirect()->route('dashboard');
        $message = 'Thank you for verifying your email address. We will reach out to you to validate your business.';
        $messageAr = null;
        
        return view('layouts.frontend.verify',compact('message','messageAr'));


    }


    public function login(Request $request){

        $params = $this->validate($request, [
            'email'=>'required',
            'password' => 'required|min:6',
        ]);

        $user = User::query()->where('email',$params['email'])->first();

        if($user->email_verified == 1){

            if (auth()->attempt($params)) {

                $user = auth()->user();

                $user->last_login = Carbon::now();

                $user->save();

                $token = auth()->user()->createToken("alsaedan")->accessToken;


                return response(['user'=>$user, 'token'=>$token],200);

            }

        }
        return response(['message'=>__('api.invalid_credentials')],442);

    }



    public function providerRegister( Request $request, $provider ){
        $params = $this->validate( $request ,
            ['access_token'=>'required|min:3','country_code'=>'required'],
            ['access_token'=>__('app.provider_token_error_required')]);

        try {
            if ($provider == 'facebook') {
                $FbUser = Socialite::driver('facebook')->fields(['name',
                    'first_name', 'last_name', 'email', 'gender', 'birthday'
                ])->scopes([
                    'email', 'user_birthday'
                ])->userFromToken($params['access_token']);

                $user = new User();
                $setRole = true;
                if (User::query()->where('provider_id', $FbUser->id)->count() > 0) {
                    $user = User::query()->where('provider_id', $FbUser->id)->first();
                    $setRole = false;
                }
                if ( $setRole)
                    $user->role_id = Role::query()->where('name', 'User')->first()->id;
                $user->name = $FbUser->name;
                $user->email = $FbUser->email;
                $user->photo = $FbUser->avatar;
                $user->provider_id = $FbUser->id;
                $user->country_code = $params['country_code'];
                $user->provider = 'facebook';
                $user->password = bcrypt($FbUser->id);
                $user->email_verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->email_verification_token = '';
                Auth::login($user, true);

                $user->save();

                $token = auth()->user()->createToken("joy")->access_token;


                return response(['user' => $user, 'token' => $token], 200);

            } else {
                $gUser = Socialite::driver('google')->fields(['name',
                    'first_name', 'last_name', 'email', 'gender', 'birthday'
                ])->scopes([
                    'email', 'user_birthday'
                ])->userFromToken($params['access_token']);

                $user = new User();
                $setRole = true;
                if (User::query()->where('provider_id', $gUser->id)->count() > 0) {
                    $user = User::query()->where('provider_id', $gUser->id)->first();
                    $setRole = false;
                }
                if ( $setRole)
                    $user->role_id = Role::query()->where('name', 'User')->first()->id;
                $user->name = $gUser->getName();
                $user->email = $gUser->getEmail();
                $user->photo = $gUser->getAvatar();
                $user->provider_id = $gUser->getId();
                $user->provider = 'google';
                $user->password = bcrypt($gUser->getId());
                $user->country_code = $params['country_code'];
                $user->email_verified = 1;
                $user->email_verified_at = Carbon::now();
                $user->email_verification_token = '';
                Auth::login($user, true);

                $user->save();

                $token = auth()->user()->createToken("joy")->access_token;


                return response(['user' => $user, 'token' => $token], 200);
            }
        }catch ( \Exception $exception ) {

            return response(['message' => __('api.something_went_wrong')], 200);
        }

    }

    public function deviceToken( Request $request ){
        $params = $this->validate( $request ,
            ['device_token'=>'required|min:3','device_platform'=>'required|min:3']);
        try{
            $user = auth()->user();
            $devices = $user->devices;
            if ( $devices != null ){
                $tokens = array_column($devices, 'token');
                if ( !in_array($params['device_token'], $tokens ) ){
                    $devices[]=[
                        'platform'=> $params['device_platform'],
                        'token'=> $params['device_token']
                    ];
                }
            }else{
                $devices[]=[
                    'platform'=> $params['device_platform'],
                    'token'=> $params['device_token']
                ];
            }
            $user->devices = $devices;
            $user->save();

            return response()->json(['user'=>$user],200);
        }catch ( \Exception $e ){
            return response()->json(['message'=>__('app.error_message'),'code_message'=>$e->getMessage()],500);
        }

    }

    public function profile( Request $request ){
        try{
            $user = auth()->user();
            if ( $user->refer_code == null ){
                $user->refer_code = substr(Str::slug($user->name),0,4)
                    .str_pad(User::query()->count(),6,"0",STR_PAD_LEFT);
                $user->save();
            }

            return response()->json(['user'=>$user],200);
        }catch ( \Exception $e ){
            return response()->json(['message'=>__('app.error_message'),'code_message'=>$e->getMessage()],500);
        }

    }

    public function editProfile( Request $request ){
        $params = $this->validate( $request ,
            ['name'=>'required|min:3',
                'dob'=>'nullable','photo'=>'nullable']);
        try{
            $user = auth()->user();
            $user->name = $params['name'] ;
            $user->dob = $params['dob'];
            if ( $request->has("photo") ){
                $fileName = $this->uploadAny($request->input("photo"),'users');
                $user->photo = 'storage/'.$fileName;
            }
            $user->save();
            return response()->json(['user'=>$user],200);
        }catch ( \Exception $e ){
            return response()->json(['message'=>__('app.error_message'),'code_message'=>$e->getMessage()],500);
        }

    }

    public function uploadAny($file, $folder){
        $file = base64_decode($file);
        $file_name = Str::random(25).'.png'; //generating unique file name;
        if (!Storage::disk('public')->exists($folder))
        {
            Storage::disk('public')->makeDirectory($folder);
        }
        $result = false;
        if($file!=""){ // storing image in storage/app/public Folder
            $result = Storage::disk('public')->put($folder.'/'.$file_name,$file);

        }
        if ( $result )
            return $folder.'/'.$file_name;
        else
            return null;
    }



}
