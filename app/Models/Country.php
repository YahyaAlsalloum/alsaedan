<?php

namespace App\Models;

use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Country extends Model
{
    use SoftDeletes, WidgetRender;

    protected $fillable = [
        'name', 'code','phone_code','image','currency_id'
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at', 'sport_ids','business_ids','credit_amount'
    ];

    public $fields = [
        [
            'key' => 'name',
            'title' => 'name',
            'type' => 'field',
            'db_name' => 'name'
        ],
        [
            'key' => 'code',
            'title' => 'code',
            'type' => 'field',
            'db_name' => 'code'
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
        ],
        'code' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Code',
            'id' => 'code',
            'name' => 'code',
            'isRequired' => 'true',
            'classes' => ''
        ],
        'phone_code' => [
            'input' => 'textbox',
            'type' => 'text',
            'label' => 'Phone Code',
            'id' => 'phone_code',
            'name' => 'phone_code',
            'isRequired' => 'true',
            'classes' => ''
        ],
        'credit_amount' => [
            'input' => 'textbox',
            'type' => 'number',
            'label' => 'Credit Amount',
            'id' => 'credit_amount',
            'name' => 'credit_amount',
            'isRequired' => 'true',
            'classes' => ''
        ],
        'currency_id' => [
            'references' => 'App\\Models\\Currency',
            'input' => 'select',
            'label' => 'Currency',
            'id' => 'currency_id',
            'name' => 'currency_id',
            'isRequired' => true,
            'withoutChooseOption' => true,
            'multiple' => false,
            'displayMember' => 'name',
            'valueMember' => 'id',
            'pivot_reference' => 'currency',
            'insertion_type'=>'field'
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


    public function locations(){
        return $this->hasMany(Location::class )->with('country');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class);
    }
}
