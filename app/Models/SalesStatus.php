<?php

namespace App\Models;

use App\Utils\Translator;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class SalesStatus extends Model
{
    use  WidgetRender, Translator;

    public $route = "sales-status";

    
    public $title = "Sales Status";


    protected $fillable = [
        'name','slug', 'image', 'status_id','color',
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
            'rules' => 'required|unique:sales_statuses',
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
        
        

        'color' => [
            'input' => 'textbox',
            'type' => 'color',
            'label' => 'color',
            'id' => 'color',
            'name' => 'color',
            'isRequired' => false,
            'classes' => '',
            'insertion_type' => 'field'
        ],

        
        'image' => [
            'input' => 'file',
            'type' => 'file',
            'label' => 'image',
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
    
  

    public function realestates($projectCategory_id)
    {
        return Realestate::query()->where('salesStatus_id',$this->_id)->where('projectCategory_id',$projectCategory_id)->get();
    }
    
  

}
