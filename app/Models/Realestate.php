<?php

namespace App\Models;

use App\User;
use App\Utils\Translator;
use App\Utils\WidgetRender;
use Carbon\Carbon;
use Jenssegers\Mongodb\Eloquent\Model as Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;
use Illuminate\Support\Arr;

class Realestate extends Model
{
    use  WidgetRender, Translator;

    public $route = "realestate";

    public $title = "Realestate";


    protected $fillable = [
        'name', 'image','description','location_address','address','main_color','secondary_color','land_space','virtual_navigation','status_id','projectCategory_id','salesStatus_id','slug','projectFeature_ids','colors',
    ];

    protected $hidden = [
        'id', 'created_at', 'updated_at', 'deleted_at'
    ];

    protected $appends=['buildings_count','lands_count','showrooms_count','offices_count','villas_count','floors_count','apartments_count','project_category_image','project_category_name'];


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
            'key' => 'salesStatus',
            'show' => 'name',
            'title' => 'Sales Status',
            'type' => 'object',
            'chains' => 'salesStatus',
            'db_name' => 'name'
        ],
        [
            'key' => 'projectCategory',
            'show' => 'name',
            'title' => 'Project Category',
            'type' => 'object',
            'chains' => 'projectCategory',
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

    ];

    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id');
    }

    public function projectCategory()
    {
        return $this->belongsTo(ProjectCategory::class, 'projectCategory_id');
    }
    public function salesStatus()
    {
        return $this->belongsTo(SalesStatus::class, 'salesStatus_id');
    }
    public function getApartmentStatus()
    {
        return ApartmentStatus::query()->where("_id","6374be4d0bb191153a019ad2")->first();
    }

    public function buildingsCount()
    {
        return Building::query()->where('realestate_id',$this->_id)->count();
    }
    // public function buildingsCountquery($num)
    // {

    //     $count = Building::query()->where('realestate_id',$this->_id)->count();
    //     if($num == $count){
    //         return true;
    //     }else return false;

    // }
    
    public function buildings()
    {
        $active = Status::query()->where('slug', 'active')->first()->_id;
        return Building::query()->where('realestate_id',$this->_id)->where('status_id',$active)->get();
    }
    public function villas()
    {
        return Villa::query()->where('realestate_id',$this->_id)->get();
    }

    public function villasCount()
    {
        return Villa::query()->where('realestate_id',$this->_id)->count();
    }
    public function lands()
    {
        return Land::query()->where('realestate_id',$this->_id)->get();
    }
    public function showrooms()
    {
        return Showroom::query()->where('realestate_id',$this->_id)->get();
    }

    public function projectFeatures()
    {
        return $this->belongsToMany(ProjectFeature::class,'project_features', 'projectFeature_ids', 'projectFeature_ids');
    }
    public function projectServices()
    {
        return $this->belongsToMany(ProjectService::class,'project_services', 'projectService_ids', 'projectService_ids');
    }
    public function projectGuarantees()
    {
        return $this->belongsToMany(ProjectGuarantee::class,'project_guarantees', 'projectGuarantee_ids', 'projectGuarantee_ids');
    }
    
    public function getProjectCategoryImageAttribute(){
        $categoryImages = ProjectCategory::query()->where('_id',$this->projectCategory_id)->first()->image;
        return $categoryImages;
    }
    public function getProjectCategoryNameAttribute(){
        $categoryImages = ProjectCategory::query()->where('_id',$this->projectCategory_id)->first()->name;
        return $categoryImages;
    }
    public function getBuildingsCountAttribute(){
     
        return Building::query()->where('realestate_id',$this->_id)->count();
    }
    public function getVillasCountAttribute(){
     
        return Villa::query()->where('realestate_id',$this->_id)->count();
    }
    public function getFloorsCountAttribute(){
     
        $buildings =  Building::query()->where('realestate_id',$this->_id)->get()->pluck('_id');
        return  Floor::query()->whereIn('building_id',$buildings)->count();
        
    }
    public function getShowroomsCountAttribute()
    {
        return Showroom::query()->where('realestate_id', $this->_id)->count();
    }
    public function getOfficesCountAttribute()
    {
        $showrooms=Showroom::query()->where('realestate_id',$this->_id)->get()->pluck('_id');
       
        return Office::query()->whereIn('showroom_id', $showrooms)->count();
    }
    public function getLandsCountAttribute()
    {
        return Land::query()->where('realestate_id', $this->_id)->count();
    }
   

    public function getApartmentsCountAttribute(){
     
        $buildings =  Building::query()->where('realestate_id',$this->_id)->get()->pluck('_id');
        $floors =  Floor::query()->whereIn('building_id',$buildings)->get()->pluck('_id');
        return  Apartment::query()->whereIn('floor_id',$floors)->count();
        
    }
}
