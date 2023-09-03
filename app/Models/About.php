<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class About extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "about";


    public $permission = "About";

    protected $fillable = [
        'about_us', 'about_image','our_vision', 'vision_image','our_message', 'message_image','our_identity', 'identity_image'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $fields = [
        
        [
            'key' => 'created_at',
            'title' => 'created_at',
            'type' => 'field',
            'db_name' => 'created_at'
        ],

    ];

    public $formFields = [
        

       
    ];


}
