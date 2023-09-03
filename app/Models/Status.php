<?php

namespace App\Models;

use App\User;
use App\Utils\Translator;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Status extends Model
{
    use SoftDeletes, WidgetRender, Translator;

    protected $fillable = ['name', 'name_ar', 'color'];

    protected $hidden = ['id', 'created_at', 'updated_at', 'deleted_at'];

    public $fields = [
        [
            'key' => 'name',
            'title' => 'Name',
            'type' => 'field',
            'db_name' => 'statuses.name'
        ],
    ];

    public $formFields = [
        'name' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Name',
            'id' => 'name',
            'name' => 'name',
            'isRequired' => 'true',
            'classes' => ''
        ]
    ];


    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }

}
