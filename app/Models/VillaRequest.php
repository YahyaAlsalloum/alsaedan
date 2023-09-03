<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class VillaRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "villa-request";

    public $title = "VillaRequest";
    public $permission = "VillaRequest";

    protected $fillable = [
        'name','email', 'phone','villa_id','realestate_id'
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
            'key' => 'realestate',
            'show' => 'name',
            'title' => 'Realestate',
            'type' => 'object',
            'chains' => 'realestate',
            'db_name' => 'name'
        ],


        [
            'key' => 'villa',
            'show' => 'number',
            'title' => 'Villa',
            'type' => 'object',
            'chains' => 'villa',
            'db_name' => 'name'
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



    public function villa()
    {
        return $this->belongsTo(Villa::class,'villa_id');
    }


    public function realestate()
    {
        return $this->belongsTo(Realestate::class,'realestate_id');
    }


}
