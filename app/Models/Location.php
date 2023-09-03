<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Location extends Model
{
    use SoftDeletes, WidgetRender;

    public $route = "location";

    public $title = "locations";


    protected $fillable = [
        'name' ,'phone_number' ,'transfer' ,'email','icon'
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
            'key' => 'phone_number',
            'title' => 'phone_number',
            'type' => 'field',
            'selection' => 'phone_number',
            'db_name' => 'phone_number'
        ],
        [
            'key' => 'transfer',
            'title' => 'transfer',
            'type' => 'field',
            'selection' => 'transfer',
            'db_name' => 'transfer'
        ],
        [
            'key' => 'email',
            'title' => 'email',
            'type' => 'field',
            'selection' => 'email',
            'db_name' => 'email'
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
        'phone_number' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Phone Number',
            'id' => 'phone_number',
            'name' => 'phone_number',
            'isRequired' => true,
            'classes' => '',
            'rules'=>'required',
            'insertion_type'=>'field'
        ],
        'transfer' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Transfer',
            'id' => 'transfer',
            'name' => 'transfer',
            'isRequired' => true,
            'classes' => '',
            'rules'=>'required',
            'insertion_type'=>'field'
        ],
        'email' => [
            'input' => 'textbox',
            'type' => 'email',
            'label' => 'Email',
            'id' => 'email',
            'name' => 'email',
            'isRequired' => true,
            'classes' => '',
            'rules'=>'required',
            'insertion_type'=>'field'
        ],
        
        'icon' => [
            'input' => 'file',
            'type' => 'file',
            'label' => 'Icon',
            'id' => 'icon',
            'name' => 'icon',
            'isRequired' => true,
            'custom' => false,
            'insertion_type'=>'field',
        ],
    ];

    // public  function getCreatedAtAttribute($v)
    // {
    //     return Carbon::parse($v)->shortRelativeToNowDiffForHumans();
    // }


}
