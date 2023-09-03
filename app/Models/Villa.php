<?php

namespace App\Models;

use App\User;
use App\Utils\Translator;
use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Villa extends Model
{
    use SoftDeletes, WidgetRender, Translator;

    public $route = "villa";

    public $title = "Villa";


    protected $fillable = [
        'number','space','rooms','price', 'image','description','status_id','villaStatus_id','realestate_id','slug',
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $appends = [];


    public $fields = [
        [
            'key' => 'number',
            'title' => 'Number',
            'type' => 'field',
            'selection' => 'name',
            'db_name' => 'number'
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
            'key' => 'apartmentStatus',
            'show' => 'name',
            'title' => 'Apartment Status',
            'type' => 'object',
            'chains' => 'apartmentStatus',
            'db_name' => 'name'
        ],
 
        [
            'key' => 'created_at',
            'title' => 'Created At',
            'type' => 'field',
            'selection' => 'created_at',
            'db_name' => 'name'
        ],
        [
            'key' => 'updated_at',
            'title' => 'Updated At',
            'type' => 'field',
            'selection' => 'updated_at',
            'db_name' => 'name'
        ],

    ];


    public $formFields = [

    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class, 'realestate_id');
    }

    public function apartmentStatus()
    {
        return $this->belongsTo(ApartmentStatus::class, 'villaStatus_id');
    }


}
