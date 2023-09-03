<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Link extends Model
{
    use SoftDeletes, WidgetRender;

    public $route = "link";

    public $title = "Social Link Types";


    protected $fillable = [
        'name', 'image'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $fields = [
        [
            'key' => 'name',
            'title' => 'name',
            'type' => 'field',
            'selection' => 'name',
            'db_name' => 'name'
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
        'status_id' => [
            'references' => 'App\\Models\\Status',
            'input' => 'select',
            'label' => 'Status',
            'id' => 'status_id',
            'name' => 'status_id',
            'isRequired' => false,
            'withoutChooseOption' => true,
            'multiple' => false,
            'displayMember' => 'name',
            'valueMember' => 'id',
            'pivot_reference' => 'status',
            'insertion_type'=>'belongsTo',
            'where_in' => ['slug',  ["active","in-active"]]
        ],
        'image' => [
            'input' => 'file',
            'type' => 'file',
            'label' => 'Image Link',
            'id' => 'logo',
            'name' => 'image',
            'isRequired' => false,
            'custom' => true,
            'insertion_type'=>'field',
        ],

    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

}
