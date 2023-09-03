<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class AboutInfo extends Model
{
    use SoftDeletes, WidgetRender;

    public $route = "about-info";

    public $title = "About Info";


    protected $fillable = [
        'name' ,'description'
    ];

    protected $hidden = [
        'id', 'updated_at', 'deleted_at'
    ];

    public $fields = [
        [
            'key' => 'name',
            'title' => 'Name',
            'type' => 'field',
            'selection' => 'name',
            'db_name' => 'name'
        ],

        [
            'key' => 'created_at',
            'title' => 'Created At',
            'type' => 'field',
            'selection' => 'created_at',
            'db_name' => 'created_at'
        ]

    ];

    public $formFields = [
        'name' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Name',
            'id' => 'name',
            'name' => 'name',
            'isRequired' => true,
            'classes' => '',
            'rules'=>'required',
            'insertion_type'=>'field'
        ],
        
        'description' => [
            'input' => 'textarea',
            'type' => 'text',
            'label' => 'description',
            'id' => 'description',
            'name' => 'description',
            'isRequired' => 'true',
            'classes' => '',
            'insertion_type' => 'field'
        ],
        
    ];

    // public  function getCreatedAtAttribute($v)
    // {
    //     return Carbon::parse($v)->shortRelativeToNowDiffForHumans();
    // }


}
