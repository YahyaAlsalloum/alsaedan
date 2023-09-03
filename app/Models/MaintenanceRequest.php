<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class MaintenanceRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "maintenance-request";

    public $title = "MaintenanceRequest";
    public $permission = "MaintenanceRequest";

    protected $fillable = [
        'name','email', 'phone','comment','company_name','company_email','company_type','country','neighborhood','city','maintenance_reason'
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
            'key' => 'company_name',
            'title' => 'Company Name',
            'type' => 'field',
            'db_name' => 'company_name'
        ],
        [
            'key' => 'company_email',
            'title' => 'Company Email',
            'type' => 'field',
            'db_name' => 'company_email'
        ],
        [
            'key' => 'company_type',
            'title' => 'Company Type',
            'type' => 'field',
            'db_name' => 'company_type'
        ],
        [
            'key' => 'country',
            'title' => 'Country',
            'type' => 'field',
            'db_name' => 'country'
        ],
        [
            'key' => 'city',
            'title' => 'City',
            'type' => 'field',
            'db_name' => 'city'
        ],
        [
            'key' => 'neighborhood',
            'title' => 'Neighborhood',
            'type' => 'field',
            'db_name' => 'neighborhood'
        ],
        [
            'key' => 'maintenance_reason',
            'title' => 'Maintenance Reason',
            'type' => 'field',
            'db_name' => 'maintenance_reason'
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
