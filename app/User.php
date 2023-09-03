<?php

namespace App;

use App\Models\Appointment;
use App\Models\Currency;
use App\Models\Role;
use App\Models\Business;
use App\Utils\Translator;
use Carbon\Carbon;
use App\Utils\Passport\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Country;
use App\Models\Status;
use App\Models\Category;
use App\Utils\WidgetRender;
use Illuminate\Auth\MustVerifyEmail;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use App\Utils\Passport\HasApiTokens;

class User extends Authenticatable implements CanResetPasswordContract
{

    use Notifiable, CanResetPassword,SoftDeletes, HasApiTokens,MustVerifyEmail, WidgetRender, Translator;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name','first_name','last_name', 'email','address','location',
        'password', 'phone', 'gender','image',
        'dob', 'role_id', 'provider_id','last_login',
        'provider','country_code','email_verified','rating',
        'email_verified_at','email_verification_token','business_id','country_id','bio','status_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'provider_id', 'device_token', 'reg_id',
         'remember_token', 'device_platform','status_id', 'otp_code',
        'email_verified_at', 'deleted_at', 'created_at', 'updated_at','email_verified','email_verification_token'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = [];

    protected $with=['role'];

    public $formFields;

    public $fields = [
        [
            'key' => 'name',
            'title' => 'Name',
            'type' => 'field',
            'db_name' => 'users.name'
        ],
        [
            'key' => 'email',
            'title' => 'Email',
            'type' => 'field',
            'db_name' => 'users.email'
        ],
        [
            'key' => 'status',
            'show' => 'name',
            'title' => 'Status',
            'type' => 'object',
            'chains' => 'status',
            'db_name' => 'name'
        ],
        [
            'key' => 'role',
            'show' => 'name',
            'title' => 'Role',
            'type' => 'object',
            'chains' => 'role',
            'db_name' => 'name'
        ],
        [
            'key' => 'phone',
            'title' => 'Phone',
            'type' => 'field',
            'db_name' => 'users.phone'
        ],
    ];

    public function __construct(array $attributes = [])
    {
        $this->formFields = [

        ];
        parent::__construct($attributes);
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }




    public function  status(){
        return $this->belongsTo(Status::class);
    }

    public function allowToAccessAdmin(){
        $id = $this->id;
        $businesses = Business::query()->whereHas('status', function($q){
            $q->where('slug','!=','pending');
        })->where(function ($q) use ($id){
            return $q->where('owner_id',$id);
        })->count();

        $staffBusiness =  Business::query()->whereHas('status', function($q){
            $q->where('slug','!=','pending');
        })->where('_id', $this->business_id)->count();

        if ($this->role->slug == 'dev' ||$this->role->slug == 'admin')
            return true;

        return ($this->status == null || $this->status->slug == 'active') && ($businesses > 0 || $staffBusiness > 0);
    }

    
    public function relatedBusinesses(){
        if ( $this->role->slug == 'dev'){
            return Business::query()->get()->pluck('_id');
        }else{
            return $this->business_ids == null ? [] : $this->business_ids;
        }
    }



}
