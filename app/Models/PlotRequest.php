<?php

namespace App\Models;
use App\User;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class PlotRequest extends Model
{
    use SoftDeletes, WidgetRender;



    public $route = "plot-request";

    public $title = "PlotRequest";
    public $permission = "PlotRequest";

    protected $fillable = [
        'name','email', 'phone','plot_id','land_id,realestate_id'
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
            'key' => 'land',
            'show' => 'name',
            'title' => 'Land',
            'type' => 'object',
            'chains' => 'Land',
            'db_name' => 'name'
        ],
        [
            'key' => 'realestate',
            'show' => 'name',
            'title' => 'Realestate',
            'type' => 'object',
            'chains' => 'Realestate',
            'db_name' => 'name'
        ],


        [
            'key' => 'plot',
            'show' => 'number',
            'title' => 'Plot',
            'type' => 'object',
            'chains' => 'Plot',
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



    public function plot()
    {
        return $this->belongsTo(Plot::class,'plot_id');
    }

    public function realestate()
    {
        return $this->belongsTo(Realestate::class,'realestate_id');
    }

    public function land()
    {
        return $this->belongsTo(Land::class,'land_id');
    }


}
