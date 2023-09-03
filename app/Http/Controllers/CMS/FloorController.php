<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Floor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class FloorController  extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Floor();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('floor.index'),
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
        $this->compacts['route'] = route('floor.index');
        $floor = new Floor();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('floor.index');
            $query = Floor::query();
            if($request->has('building_id')){
                $innerTable = true;
                $aQuery = $request->input('building_id');
                $query = $query->where('building_id', $aQuery);
            }
            return $floor->renderDataTable($query, null, $baseRoute , $innerTable);
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create(Request $request)
    {

          
        $building_id = null;
        if($request->has('building_id')){
            
            $building_id = $request->input('building_id');
        }
        return view('cms.floor.create', [
            'title' => $this->compacts['title'],
            'building_id' => $building_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Floor();
        
        $params = $request->only(
            'name',
            // 'description',
            'additional_phone',
            'status_id',
            'building_id',
        );
        $m->name = $params['name'];
        $m->slug = Str::slug($m->name);
        // $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->building_id = $params['building_id'];
        $m->save();


        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'floores/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('floores')) {
                Storage::disk('public')->makeDirectory('floores');
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
            $title = 'floores/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('floores')) {
                Storage::disk('public')->makeDirectory('floores');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();

        
        return redirect()->route('building.edit', $m->building_id);
        // return redirect()->route('floor.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $floor = Floor::findOrFail($id);
        
        return view('cms.floor.edit', [
            'floor' => $floor,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $floor = Floor::findOrFail($id);        
        return response()->json(['view' => view('cms.floor.edit-ajax', compact('floor'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Floor::query()->find($id);
        
        $params = $request->only(
            'name',
            // 'description',
            'building_id',
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
            $title = 'floores/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('floores')) {
                Storage::disk('public')->makeDirectory('floores');
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
            $title = 'floores/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('floores')) {
                Storage::disk('public')->makeDirectory('floores');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();


        return redirect()->route('building.edit', $m->building_id);
        // return redirect()->route('floor.index');
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
        Floor::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $floor = Floor::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($floor, $f, $floor->name, 'floores');

            return $res;
        } else {
            return $this->uploadImageTrait($floor, $file, $floor->name, 'floores');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $floor = Floor::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($floor, $file)]);
    }

    public function getGallery($id)
    {
        $floor = Floor::query()->findOrFail($id);

        return $this->getFilesImageTrait($floor);
    }
}
