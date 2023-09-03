<?php

namespace App\Models;

use App\User;
use App\Utils\Translator;
use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Land extends Model
{
    use SoftDeletes, WidgetRender, Translator;

    public $route = "land";

    public $title = "Land";


    protected $fillable = [
        'name', 'image','description','status_id','realestate_id','slug',
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $appends = [];


    public $fields = [
        [
            'key' => 'name',
            'title' => 'name',
            'type' => 'field',
            'selection' => 'name',
            'db_name' => 'name'
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
    
    public function plotsCount()
    {
        return Plot::query()->where('land_id',$this->_id)->count();
    }
    public function plots()
    {
        return Plot::query()->where('land_id',$this->_id)->get();
    }


}
