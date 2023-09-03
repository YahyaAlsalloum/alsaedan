<?php

namespace App\Models;

use App\User;
use App\Utils\WidgetRender;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Role extends Model
{
    use SoftDeletes, WidgetRender;

    protected $fillable = [
        'name', 'permissions'
    ];

    protected $hidden = [
        'statuses', 'description', 'created_at', 'updated_at', 'deleted_at'
    ];

    public $fields = [
        [
            'key' => 'name',
            'title' => 'Name',
            'type' => 'field',
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
            'isRequired' => 'true',
            'classes' => ''
        ],
        'status_id' => [
            'references' => 'App\\Models\\Status',
            'input' => 'select',
            'label' => 'Status',
            'id' => 'status_id',
            'name' => 'status_id',
            'isRequired' => 'true',
            'displayMember' => 'name',
            'valueMember' => 'id',
            'pivot_reference' => 'status'
        ],
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }



}
