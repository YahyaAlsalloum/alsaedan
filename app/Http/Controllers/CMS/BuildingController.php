<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Status;
use App\Models\Building;
use App\Models\Realestate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class BuildingController  extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Building();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('building.index'),
           'new' => route($model->route.'.create')
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
        $this->compacts['route'] = route('building.index');
        $building = new Building();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('building.index');
            $query = Building::query();
            if($request->has('realestate_id')){
                $innerTable = true;
                $aQuery = $request->input('realestate_id');
                $query = $query->where('realestate_id', $aQuery);
            }
            return $building->renderDataTable($query, null, $baseRoute , $innerTable);
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create(Request $request)
    {

        $active = Status::query()->where('slug','active')->first()->_id;
        
        $realestates = Realestate::all();
        
        $realestate_id = null;
        if($request->has('realestate_id')){
            
            $realestate_id = $request->input('realestate_id');
        }
        return view('cms.building.create', [
            'title' => $this->compacts['title'],
            'realestates' => $realestates,
            'realestate_id' => $realestate_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Building();
        
        $params = $request->only(
            'name',
            // 'description',
            'additional_phone',
            'status_id',
            'realestate_id',
        );
        $m->name = $params['name'];
        $m->slug = Str::slug($m->name);
        // $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->realestate_id = $params['realestate_id'];
        $m->save();

        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'buildinges/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('buildinges')) {
                Storage::disk('public')->makeDirectory('buildinges');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->logo = 'storage/' . $title;
        }else{
            
            if($request->hidden_logo == 0)
            $m->logo = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'buildinges/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('buildinges')) {
                Storage::disk('public')->makeDirectory('buildinges');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();

        
        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('building.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $building = Building::findOrFail($id);
        
        return view('cms.building.edit', [
            'building' => $building,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $building = Building::findOrFail($id);        
        return response()->json(['view' => view('cms.building.edit-ajax', compact('building'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Building::query()->find($id);
        
        $params = $request->only(
            'name',
            // 'description',
            'realestate_id',
            'status_id',
           
        );
        $m->update($params);
        $m->save();
        // types
        
        if ($request->is_featured == "on") {
            $m->is_featured =  true;
        } else {
            $m->is_featured =  false;
        }



        $m->save();
        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'buildinges/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('buildinges')) {
                Storage::disk('public')->makeDirectory('buildinges');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->logo = 'storage/' . $title;
        }else{
            
            if($request->hidden_logo == 0)
            $m->logo = null;
        }
        $m->save();
        if ($request->has("cover_image")) {
            $f = $request->file("cover_image");
            $title = 'buildinges/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('buildinges')) {
                Storage::disk('public')->makeDirectory('buildinges');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();


        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('building.index');
    }

    public function getPermissions($permissions, $module)
    {
        if ($permissions != null && in_array('all', $permissions))
            return ['show', 'edit', 'delete', 'add'];//because of the custom fields to avoid not to be viewed when permitted
        elseif (!isset($permissions[$module]))
            return abort(403);
        return $permissions[$module];
    }
    
    public function destroy($id){
        Building::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $building = Building::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($building, $f, $building->name, 'buildinges');

            return $res;
        } else {
            return $this->uploadImageTrait($building, $file, $building->name, 'buildinges');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $building = Building::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($building, $file)]);
    }

    public function getGallery($id)
    {
        $building = Building::query()->findOrFail($id);

        return $this->getFilesImageTrait($building);
    }
}
