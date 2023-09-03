<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ContactRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "contact-request";

    public $title = "ContactRequest";
    public $permission = "ContactRequest";

    protected $fillable = [
        'name','email', 'phone','comment'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $fields = [
        

        [
            'key' => 'name',
            'title' => 'Name',
            'type' => 'field',
            'db_name' => 'name'
        ],
        
        [
            'key' => 'email',
            'title' => 'Email',
            'type' => 'field',
            'db_name' => 'email'
        ],
        [
            'key' => 'phone',
            'title' => 'Phone',
            'type' => 'field',
            'db_name' => 'phone'
        ],
        [
            'key' => 'comment',
            'title' => 'Comment',
            'type' => 'field',
            'db_name' => 'comment'
        ],
        [
            'key' => 'created_at',
            'title' => 'Date',
            'type' => 'field',
            'db_name' => 'created_at'
        ],

    ];

    public $formFields = [

    ];



    
  

}
