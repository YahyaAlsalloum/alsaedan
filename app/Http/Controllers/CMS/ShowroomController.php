<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Status;
use App\Models\Showroom;
use App\Models\Realestate;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class ShowroomController  extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Showroom();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('showroom.index'),
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
        $this->compacts['route'] = route('showroom.index');
        $showroom = new Showroom();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('showroom.index');
            $query = Showroom::query();
            if($request->has('realestate_id')){
                $innerTable = true;
                $aQuery = $request->input('realestate_id');
                $query = $query->where('realestate_id', $aQuery);
            }
            return $showroom->renderDataTable($query, null, $baseRoute , $innerTable);
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
        return view('cms.showroom.create', [
            'title' => $this->compacts['title'],
            'realestates' => $realestates,
            'realestate_id' => $realestate_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Showroom();
        
        $params = $request->only(
            'name',
            // 'description',
            'additional_phone',
            'status_id',
            'realestate_id',
        );
        $m->name = $params['name'];
        $m->slug = Str::slug($m->name);
        $m->status_id = $params['status_id'];
        $m->realestate_id = $params['realestate_id'];
        $m->save();

        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];


        if ($request->has("logo")) {
            $f = $request->file("logo");
            $title = 'showroomes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showroomes')) {
                Storage::disk('public')->makeDirectory('showroomes');
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
            $title = 'showroomes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showroomes')) {
                Storage::disk('public')->makeDirectory('showroomes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();

        
        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('showroom.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $showroom = Showroom::findOrFail($id);
        
        return view('cms.showroom.edit', [
            'showroom' => $showroom,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $showroom = Showroom::findOrFail($id);        
        return response()->json(['view' => view('cms.showroom.edit-ajax', compact('showroom'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Showroom::query()->find($id);
        
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
            $title = 'showroomes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showroomes')) {
                Storage::disk('public')->makeDirectory('showroomes');
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
            $title = 'showroomes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('showroomes')) {
                Storage::disk('public')->makeDirectory('showroomes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->cover_image = 'storage/' . $title;
        }else{
            if($request->hidden_cover_image == 0)
            $m->cover_image = null;
        }
        $m->save();


        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('showroom.index');
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
        Showroom::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $showroom = Showroom::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($showroom, $f, $showroom->name, 'showroomes');

            return $res;
        } else {
            return $this->uploadImageTrait($showroom, $file, $showroom->name, 'showroomes');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $showroom = Showroom::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($showroom, $file)]);
    }

    public function getGallery($id)
    {
        $showroom = Showroom::query()->findOrFail($id);

        return $this->getFilesImageTrait($showroom);
    }
}
