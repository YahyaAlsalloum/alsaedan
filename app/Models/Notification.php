<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Notification extends Model
{
    use SoftDeletes, WidgetRender;

    public $route = "notification";

    public $title = "Notifications";


    protected $fillable = [
        'name' ,'message' ,'user_from' ,'user_to','related_id', 'data','read','type'
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
            'key' => 'message',
            'title' => 'Message',
            'type' => 'field',
            'selection' => 'message',
            'db_name' => 'message'
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
        ]
    ];

    // public  function getCreatedAtAttribute($v)
    // {
    //     return Carbon::parse($v)->shortRelativeToNowDiffForHumans();
    // }


}
