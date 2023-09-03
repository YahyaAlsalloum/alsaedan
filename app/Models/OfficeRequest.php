<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class OfficeRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "office-request";

    public $title = "OfficeRequest";
    public $permission = "OfficeRequest";

    protected $fillable = [
        'name','email', 'phone','office','showroom','realestate_id'
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
            'key' => 'showroom',
            'show' => 'name',
            'title' => 'Showroom',
            'type' => 'object',
            'chains' => 'showroom',
            'db_name' => 'name'
        ],
        [
            'key' => 'realestate',
            'show' => 'name',
            'title' => 'Realestate',
            'type' => 'object',
            'chains' => 'realestate',
            'db_name' => 'name'
        ],

        [
            'key' => 'office',
            'show' => 'number',
            'title' => 'Office',
            'type' => 'object',
            'chains' => 'office',
            'db_name' => 'number'
        ],
        [
            'key' => 'email',
            'title' => 'Email',
            'type' => 'field',
            'db_name' => 'email'
        ],
        [
            'key' => 'payment',
            'title' => 'Payment',
            'type' => 'field',
            'db_name' => 'payment'
        ],
        [
            'key' => 'phone',
            'title' => 'Phone',
            'type' => 'field',
            'db_name' => 'phone'
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



    
    public function office()
    {
        return $this->belongsTo(Office::class,'office_id');
    }
    public function realestate()
    {
        return $this->belongsTo(Realestate::class,'realestate_id');
    }

    public function showroom()
    {
        return $this->belongsTo(Showroom::class,'showroom_id');
    }


}
