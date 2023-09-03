<?php

namespace App\Models;


use App\User;
use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use SoftDeletes, WidgetRender;

    public $route = "feedback";

    public $title = "Feedbacks";


    protected $fillable = [
        'name' ,'message' ,'user_id','business_id'
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


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

}
