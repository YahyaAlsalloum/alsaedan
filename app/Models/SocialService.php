<?php

namespace App\Models;

use App\Utils\Translator;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SocialService extends Model
{
    use  WidgetRender, Translator;

    public $route = "social-service";

    
    public $title = "Social Service";


    protected $fillable = [
        'name','slug', 'image', 'status_id','description',
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
        'name' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Name',
            'id' => 'name',
            'name' => 'name',
            'isRequired' => true,
            'classes' => '',
            'insertion_type' => 'field'
        ],


        'status_id' => [
            'references' => 'App\\Models\\Status',
            'input' => 'select',
            'label' => 'Status',
            'id' => 'status_id',
            'name' => 'status_id',
            'isRequired' => true,
            'withoutChooseOption' => false,
            'multiple' => false,
            'displayMember' => 'name',
            'valueMember' => 'id',
            'pivot_reference' => 'status',
            'insertion_type' => 'belongsTo'
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
        
        'image' => [
            'input' => 'file',
            'type' => 'file',
            'label' => 'Background Image',
            'id' => 'image',
            'name' => 'image',
            'isRequired' => true,
            'custom' => false,
            'insertion_type'=>'field',
        ],

        
    ];



    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }
    
  

}
