<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Setting extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "setting";


    public $permission = "Setting";

    protected $fillable = [
        'contact_phone',
        'contact_email',
        'contact_website', 
        'opening_hours', 
        'address', 
        'location',
        'linkedin',
        'twitter',
        'instagram',
        'facebook', 
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
