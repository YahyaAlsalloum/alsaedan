<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\ProjectFeature;
use App\Models\ProjectService;
use App\Models\ProjectGuarantee;
use App\Models\Status;
use App\Models\Realestate;
use App\Models\ApartmentStatus;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class RealestateController extends Controller
{

    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Realestate();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('realestate.index'),
            'new' => route($model->route . '.create')
        ];
        $rules = [];
        foreach ($model->formFields as $name => $field) {
            if (Arr::has($field, 'rules'))
                $rules[$name] = $field['rules'];
        }
        $this->validationRules = $rules;
        $this->module = $model;
    }

    public function index(Request $request)
    {
        if ($request->ajax()) {
            return $this->module->renderDataTable($this->module::query(), [], route('realestate.index'));
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create()
    {

        $active = Status::query()->where('slug', 'active')->first()->_id;
        $apartmentStatuses = ApartmentStatus::query()->get();
        $projectFeatures = ProjectFeature::query()->where('status_id', $active)->get();
        $projectServices = ProjectService::query()->where('status_id', $active)->get();
        $projectGuarantees = ProjectGuarantee::query()->where('status_id', $active)->get();

        return view('cms.realestate.create', [

            'title' => $this->compacts['title'],
            'projectFeatures' => $projectFeatures,
            'projectServices' => $projectServices,
            'projectGuarantees' => $projectGuarantees,
            'apartmentStatuses' => $apartmentStatuses,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Realestate();
        $this->validate($request, [
            'name' => 'required|unique:realestates',
        ]);
        $params = $request->only(
            'name',
            'virtual_navigation',
            'land_space',
            'description',
            'additional_phone',
            'status_id',
            'projectCategory_id',
            'salesStatus_id',
            'address',
            'main_color',
            'secondary_color',
        );
        $m->name = $params['name'];
        $m->virtual_navigation = $params['virtual_navigation'];
        $m->land_space = $params['land_space'];
        $m->slug = Str::slug($m->name);
        $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->projectCategory_id = $params['projectCategory_id'];
        $m->salesStatus_id = $params['salesStatus_id'];
        $m->address = $params['address'];
        $m->main_color = $params['main_color'];
        $m->secondary_color = $params['secondary_color'];


        $m->save();
        if($request->has('projectFeature_ids'))
        $m->projectFeatures()->attach($request->input('projectFeature_ids'));
        $m->save();
        if($request->has('projectService_ids'))
        $m->projectServices()->attach($request->input('projectService_ids'));
        $m->save();
        if($request->has('projectGuarantee_ids'))
        $m->projectGuarantees()->attach($request->input('projectGuarantee_ids'));
        $m->save();
        if($request->has('address_points')){
            $points = explode(",",$request->input('address_points'));
            $points = array_chunk($points,2);
            $m->address_points = $points;
            $m->save();
        }
        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->logo = 'storage/' . $title;
        } else {

            if ($request->hidden_logo == 0)
                $m->logo = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        } else {

            if ($request->hidden_cover_image == 0)
                $m->cover_image = null;
        }
        $m->save();

        if ($request->has("banner")) {
            $f = $request->file("banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->banner = 'storage/' . $title;
        } else {

            if ($request->hidden_banner == 0)
                $m->banner = null;
        }
        $m->save();
        $advantage_names = $request->input('advantage_names');
        $advantage_descriptions = $request->input('advantage_descriptions');
        $objectImage = $request->file('object_images');
        $hidden_val = $request->input('advantage_hidden_val');

        $storedAdvantage = array();
        if ($advantage_names != null) {
            foreach ($advantage_names as $key => $value) {
                if (isset($m->advantage_values[$key]['image']))
                    $img = $m->advantage_values[$key]['image'];
                $nm = $request->advantage_hidden_val[$key] . '';
                if (isset($hidden_val[$key]) and $hidden_val[$key] != null and isset($objectImage[$key]) and $objectImage[$key] != null) {
                    $f = $objectImage[$key];
                    $title = 'realestates/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('realestates')) {
                        Storage::disk('public')->makeDirectory('realestates');
                    }
                    Storage::disk('public')->put($title, file_get_contents($f));
                    $img = 'storage/' . $title;
                } else {
                    if ($request->$nm == 0)
                        $img = null;
                }
                $storedAdvantage[] = [
                    'advantage_name' => $advantage_names[$key],
                    'advantage_description' =>  $advantage_descriptions[$key],
                    'image' => $img,
                ];
            }
        }
        $m->advantage_values = $storedAdvantage;

        $m->save();

        $surrounding_names = $request->input('surrounding_names');
        $surrounding_descriptions = $request->input('surrounding_descriptions');
        $surroundingImage = $request->file('surrounding_images');
        $hidden_val = $request->input('surrounding_hidden_val');

        $storedSurrounding = array();
        if ($surrounding_names != null) {
            foreach ($surrounding_names as $key => $value) {
                if (isset($m->surrounding_values[$key]['image']))
                    $img = $m->surrounding_values[$key]['image'];
                $nm = $request->surrounding_hidden_val[$key] . '';
                if (isset($hidden_val[$key]) and $hidden_val[$key] != null and isset($surroundingImage[$key]) and $surroundingImage[$key] != null) {
                    $f = $surroundingImage[$key];
                    $title = 'realestates/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('realestates')) {
                        Storage::disk('public')->makeDirectory('realestates');
                    }
                    Storage::disk('public')->put($title, file_get_contents($f));
                    $img = 'storage/' . $title;
                } else {
                    if ($request->$nm == 0)
                        $img = null;
                }
                $storedSurrounding[] = [
                    'surrounding_name' => $surrounding_names[$key],
                    'surrounding_description' =>  $surrounding_descriptions[$key],
                    'image' => $img,
                ];
            }
        }
        $m->surrounding_values = $storedSurrounding;

        $m->save();
        
        $colors_ids = $request->input('colors_ids');
        $colors = $request->input('colors');
     
        $storedColors = array();
        if ($colors_ids != null) {
            foreach ($colors_ids as $key => $colors_id) {
        
                $storedColors[] = [
                    'colors_id' => $colors_ids[$key],
                    'color' =>  $colors[$key],
                ];
            }
        }
        $m->colors = $storedColors;
        $m->save();

        return redirect()->route('realestate.index');
    }

    public function edit(Request $request, $id)
    {
        $realestate = Realestate::findOrFail($id);

        $active = Status::query()->where('slug', 'active')->first()->_id;
        $projectFeatures = ProjectFeature::query()->where('status_id', $active)->get();
        $apartmentStatuses = ApartmentStatus::query()->get();
        $projectServices = ProjectService::query()->where('status_id', $active)->get();
        $projectGuarantees = ProjectGuarantee::query()->where('status_id', $active)->get();
        return view(
            'cms.realestate.edit',
            [
                'realestate' => $realestate,
                'projectFeatures' => $projectFeatures,
                'projectServices' => $projectServices,
                'projectGuarantees' => $projectGuarantees,
                'apartmentStatuses' => $apartmentStatuses,
            ],
            $this->compacts
        );

    }


    public function update(Request $request, $id)
    {
        
        $m = Realestate::query()->find($id);
        
        $params = $request->only(
            'name',
            'virtual_navigation',
            'land_space',
            'description',
            'status_id',
            'projectCategory_id',
            'salesStatus_id',
            'address',
            'main_color',
            'secondary_color',

        );
        $m->update($params);
        
        // $m->slug = Str::slug($m->name);
        $m->save();
        
        $m->projectFeatures()->detach();
        $m->projectFeature_ids = [];
        $m->projectGuarantees()->detach();
        $m->projectGuarantee_ids = [];
        $m->projectServices()->detach();
        $m->projectService_ids = [];
        $m->save();
        if($request->has('projectFeature_ids'))
        $m->projectFeatures()->attach($request->input('projectFeature_ids'));
        $m->save();

        if($request->has('projectService_ids'))
        $m->projectServices()->attach($request->input('projectService_ids'));
        $m->save();
        
      
        if($request->has('projectGuarantee_ids'))
        $m->projectGuarantees()->attach($request->input('projectGuarantee_ids'));
        $m->save();
        // types

        if ($request->is_featured == "on") {
            $m->is_featured =  true;
        } else {
            $m->is_featured =  false;
        }

        if($request->has('address_points')){
            $points = explode(",",$request->input('address_points'));
            $points = array_chunk($points,2);
            $m->address_points = $points;
            $m->save();
        }
        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        $m->save();
        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->logo = 'storage/' . $title;
        } else {

            if ($request->hidden_logo == 0)
                $m->logo = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        } else {
            if ($request->hidden_cover_image == 0)
                $m->cover_image = null;
        }
        $m->save();

        if ($request->has("banner")) {
            $f = $request->file("banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->banner = 'storage/' . $title;
        } else {
            if ($request->hidden_banner == 0)
                $m->banner = null;
        }
        $m->save();
        if ($request->has("gallery_banner")) {
            $f = $request->file("gallery_banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->gallery_banner = 'storage/' . $title;
        } else {
            if ($request->hidden_gallery_banner == 0)
                $m->gallery_banner = null;
        }
        $m->save();
        if ($request->has("guarantees_banner")) {
            $f = $request->file("guarantees_banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->guarantees_banner = 'storage/' . $title;
        } else {
            if ($request->hidden_guarantees_banner == 0)
                $m->guarantees_banner = null;
        }
        $m->save();
        if ($request->has("gift_banner")) {
            $f = $request->file("gift_banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->gift_banner = 'storage/' . $title;
        } else {
            if ($request->hidden_gift_banner == 0)
                $m->gift_banner = null;
        }
        $m->save();
        if ($request->has("features_banner")) {
            $f = $request->file("features_banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->features_banner = 'storage/' . $title;
        } else {
            if ($request->hidden_features_banner == 0)
                $m->features_banner = null;
        }
        $m->save();
        if ($request->has("advantages_banner")) {
            $f = $request->file("advantages_banner");
            $title = 'realestatees/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('realestatees')) {
                Storage::disk('public')->makeDirectory('realestatees');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->advantages_banner = 'storage/' . $title;
        } else {
            if ($request->hidden_advantages_banner == 0)
                $m->advantages_banner = null;
        }
        $m->save();
        $advantage_names = $request->input('advantage_names');
        $advantage_descriptions = $request->input('advantage_descriptions');
        $objectImage = $request->file('object_images');
        $hidden_val = $request->input('advantage_hidden_val');
        // dd($hidden_val);
        $storedAdvantage = array();
        if ($advantage_names != null) {
            foreach ($advantage_names as $key => $advantage_name) {
                if (isset($m->advantage_values[$key]['image']))
                    $img = $m->advantage_values[$key]['image'];
                $nm = $request->advantage_hidden_val[$key] . '';
                if (isset($hidden_val[$key]) and $hidden_val[$key] != null and isset($objectImage[$key]) and $objectImage[$key] != null) {
                    $f = $objectImage[$key];
                    $title = 'realestates/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('realestates')) {
                        Storage::disk('public')->makeDirectory('realestates');
                    }
                    Storage::disk('public')->put($title, file_get_contents($f));
                    $img = 'storage/' . $title;
                } else {
                    if ($request->$nm == 0)
                        $img = null;
                }
                $storedAdvantage[] = [
                    'advantage_name' => $advantage_names[$key],
                    'advantage_description' =>  $advantage_descriptions[$key],
                    'image' => $img,
                ];
            }
        }
        $m->advantage_values = $storedAdvantage;

        $m->save();
        $surrounding_names = $request->input('surrounding_names');
        $surrounding_descriptions = $request->input('surrounding_descriptions');
        $surroundingImage = $request->file('surrounding_images');
        $hidden_val = $request->input('surrounding_hidden_val');
        $storedSurrounding = array();
        // dd($request->surrounding_hidden_val);
        if ($surrounding_names != null) {
            foreach ($surrounding_names as $key => $surrounding_name) {
                if (isset($m->surrounding_values[$key]['image']))
                    $img = $m->surrounding_values[$key]['image'];
                $nm = $request->surrounding_hidden_val[$key] . '';
                if (isset($hidden_val[$key]) and $hidden_val[$key] != null and isset($surroundingImage[$key]) and $surroundingImage[$key] != null) {
                    $f = $surroundingImage[$key];
                    $title = 'realestates/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('realestates')) {
                        Storage::disk('public')->makeDirectory('realestates');
                    }
                    Storage::disk('public')->put($title, file_get_contents($f));
                    $img = 'storage/' . $title;
                } else {
                    if ($request->$nm == 0)
                        $img = null;
                }
                $storedSurrounding[] = [
                    'surrounding_name' => $surrounding_names[$key],
                    'surrounding_description' =>  $surrounding_descriptions[$key],
                    'image' => $img,
                ];
            }
        }
        $m->surrounding_values = $storedSurrounding;

        $m->save();
        
        $colors_ids = $request->input('colors_ids');
        $colors = $request->input('colors');
        // dd($colors_ids,$colors);
        $storedColors = array();
        if ($colors_ids != null) {
            foreach ($colors_ids as $key => $colors_id) {
        
                $storedColors[] = [
                    'colors_id' => $colors_ids[$key],
                    'color' =>  $colors[$key],
                ];
            }
        }
        $m->colors = $storedColors;
        $m->save();

        return redirect()->route('realestate.index');
    }

    public function getPermissions($permissions, $module)
    {
        if ($permissions != null && in_array('all', $permissions))
            return ['show', 'edit', 'delete', 'add']; //because of the custom fields to avoid not to be viewed when permitted
        elseif (!isset($permissions[$module]))
            return abort(403);
        return $permissions[$module];
    }

    public function destroy($id)
    {
        Realestate::query()->findOrFail($id)->delete();
    }

    public function uploadImage(Request $request, $id)
    {
        $realestate = Realestate::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res[] = $this->uploadImageTrait($realestate, $f, $realestate->name, 'realestatees');

            return $res;
        } else {
            return $this->uploadImageTrait($realestate, $file, $realestate->name, 'realestatees');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $realestate = Realestate::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($realestate, $file)]);
    }

    public function getGallery($id)
    {
        $realestate = Realestate::query()->findOrFail($id);

        return $this->getFilesImageTrait($realestate);
    }
}
