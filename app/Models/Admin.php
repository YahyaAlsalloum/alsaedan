<?php

namespace App\Models;

use App\User;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Builder;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;


class Admin extends User
{
    //
    use SoftDeletes, WidgetRender;

    protected $table = "users";


    public static function boot()
    {
        parent::boot();
        $role = Role::query()->where('slug', 'admin')->first()->_id;
        static::addGlobalScope('adminRole', function (Builder $builder) use ($role)  {
            $builder->where('role_id', $role );

        });
    }


    public function role(){
        return $this->belongsTo(Role::class);
    }
}
