<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Status;
use App\Models\BusinessProject;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class BusinessProjectController extends Controller
{

    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new BusinessProject();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('business-project.index'),
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
            return $this->module->renderDataTable($this->module::query(), [], route('business-project.index'));
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create()
    {

        $active = Status::query()->where('slug', 'active')->first()->_id;

        return view('cms.business-project.create', [

            'title' => $this->compacts['title'],
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new BusinessProject();
        $this->validate($request, [
            'name' => 'required|unique:business_projects',
        ]);
        $params = $request->only(
            'name',
            'description',
            'additional_phone',
            'status_id',
            'businessCategory_id',
            'salesStatus_id',
            'address',
            'address_title',
            'building_area',
            'land_area',
        );
        $m->name = $params['name'];
        $m->slug = Str::slug($m->name);
        $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->businessCategory_id = $params['businessCategory_id'];
        $m->address = $params['address'];
        $m->address_title = $params['address_title'];
        $m->building_area = $params['building_area'];
        $m->land_area = $params['land_area'];
        $m->save();
        if($request->has('address_points')){
            $points = explode(",",$request->input('address_points'));
            $points = array_chunk($points,2);
            $m->address_points = $points;
            $m->save();
        }
        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'business-projectes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('business-projectes')) {
                Storage::disk('public')->makeDirectory('business-projectes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        } else {

            if ($request->hidden_image == 0)
                $m->image = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'business-projectes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('business-projectes')) {
                Storage::disk('public')->makeDirectory('business-projectes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        } else {

            if ($request->hidden_cover_image == 0)
                $m->cover_image = null;
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
                    $title = 'business-projects/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
                    if (!Storage::disk('public')->exists('business-projects')) {
                        Storage::disk('public')->makeDirectory('business-projects');
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

        $unit_names = $request->input('unit_names');
        $unit_numbers = $request->input('unit_numbers');

        $storedUnits = array();
        if ($unit_names != null) {
            foreach ($unit_names as $key => $value) {
         
                $storedUnits[] = [
                    'unit_name' => $unit_names[$key],
                    'unit_number' => $unit_numbers[$key],
                ];
            }
        }
        $m->unit_values = $storedUnits;

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

        return redirect()->route('business-project.index');
    }

    public function edit(Request $request, $id)
    {
        $businessProject = BusinessProject::findOrFail($id);

        $active = Status::query()->where('slug', 'active')->first()->_id;

        return view(
            'cms.business-project.edit',
            [
                'businessProject' => $businessProject,
            ],
            $this->compacts
        );

    }


    public function update(Request $request, $id)
    {
        
        $m = BusinessProject::query()->find($id);
        
        $params = $request->only(
            'name',
            'description',
            'status_id',
            'businessCategory_id',
            'salesStatus_id',
            'address',
            'address_title',
            'building_area',
            'land_area',


        );
        $m->update($params);
        
        // $m->slug = Str::slug($m->name);
        $m->save();
        

        if($request->has('address_points')){
            $points = explode(",",$request->input('address_points'));
            $points = array_chunk($points,2);
            $m->address_points = $points;
            $m->save();
        }
        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        $m->save();
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'business-projectes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('business-projectes')) {
                Storage::disk('public')->makeDirectory('business-projectes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        } else {

            if ($request->hidden_image == 0)
                $m->image = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'business-projectes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('business-projectes')) {
                Storage::disk('public')->makeDirectory('business-projectes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        } else {
            if ($request->hidden_cover_image == 0)
                $m->cover_image = null;
        }
        $m->save();

        
        $unit_names = $request->input('unit_names');
        $unit_numbers = $request->input('unit_numbers');

        $storedUnits = array();
        if ($unit_names != null) {
            foreach ($unit_names as $key => $value) {
         
                $storedUnits[] = [
                    'unit_name' => $unit_names[$key],
                    'unit_number' => $unit_numbers[$key],
                ];
            }
        }
        $m->unit_values = $storedUnits;

        $m->save();

        $m->save();
        return redirect()->route('business-project.index');
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
        BusinessProject::query()->findOrFail($id)->delete();
    }

    public function uploadImage(Request $request, $id)
    {
        $businessProject = BusinessProject::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res[] = $this->uploadImageTrait($businessProject, $f, $businessProject->name, 'business-projectes');

            return $res;
        } else {
            return $this->uploadImageTrait($businessProject, $file, $businessProject->name, 'business-projectes');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $businessProject = BusinessProject::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($businessProject, $file)]);
    }

    public function getGallery($id)
    {
        $businessProject = BusinessProject::query()->findOrFail($id);

        return $this->getFilesImageTrait($businessProject);
    }
}
