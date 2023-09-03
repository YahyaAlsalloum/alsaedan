<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Home extends Model
{
    //
    use SoftDeletes, WidgetRender;

    public $route = "home";

    protected $fillable =['title','body','image','appStore', 'googlePlay'];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];


}
