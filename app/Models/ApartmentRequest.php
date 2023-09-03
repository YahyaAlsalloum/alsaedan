<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class ApartmentRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "apartment-request";

    public $title = "ApartmentRequest";
    public $permission = "ApartmentRequest";

    protected $fillable = [
        'name','email', 'phone','apartment_id','floor_id','building_id','realestate_id'
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
            'key' => 'building',
            'show' => 'name',
            'title' => 'Building',
            'type' => 'object',
            'chains' => 'building',
            'db_name' => 'name'
        ],
        [
            'key' => 'floor',
            'show' => 'name',
            'title' => 'Floor',
            'type' => 'object',
            'chains' => 'floor',
            'db_name' => 'name'
        ],
        [
            'key' => 'apartment',
            'show' => 'number',
            'title' => 'Apartment',
            'type' => 'object',
            'chains' => 'apartment',
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



    public function apartment()
    {
        return $this->belongsTo(Apartment::class,'apartment_id');
    }
    public function floor()
    {
        return $this->belongsTo(Floor::class,'floor_id');
    }

    public function building()
    {
        return $this->belongsTo(Building::class,'building_id');
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class,'realestate_id');
    }


}
