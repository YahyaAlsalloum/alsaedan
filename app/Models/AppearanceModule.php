<?php

namespace App\Models;

use App\Utils\Translator;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class AppearanceModule extends Model
{
    use  WidgetRender, Translator;

    public $route = "appearance-module";

    
    public $title = "Appearance Module";


    protected $fillable = [
        'name','display_title','slug',
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
        ],
        
        [
            'key' => 'display_title',
            'title' => 'display title',
            'type' => 'field',
            'selection' => 'display_title',
            'db_name' => 'display_title'
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
        'name' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Name',
            'id' => 'name',
            'name' => 'name',
            'isRequired' => true,
            'classes' => '',
            'rules' => 'required|unique:apperance_modules',
            'insertion_type' => 'field'
        ],


        'display_title' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Display Title',
            'id' => 'display_title',
            'name' => 'display_title',
            'isRequired' => true,
            'classes' => '',
            'insertion_type' => 'field'
        ],


        

        
    ];



    
  

}
