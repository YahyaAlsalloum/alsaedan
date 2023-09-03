<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Apartment;
use App\Models\Floor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class ApartmentController extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Apartment();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('apartment.index'),
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
        $this->compacts['route'] = route('apartment.index');
        $apartment = new Apartment();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('apartment.index');
            $query = Apartment::query();
            if($request->has('floor_id')){
                $innerTable = true;
                $aQuery = $request->input('floor_id');
                $query = $query->where('floor_id', $aQuery);
            }
            return $apartment->renderDataTable($query, null, $baseRoute , $innerTable);
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create(Request $request)
    {

          
        $floor_id = null;
        if($request->has('floor_id')){
            
            $floor_id = $request->input('floor_id');
        }
        return view('cms.apartment.create', [
            'title' => $this->compacts['title'],
            'floor_id' => $floor_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Apartment();
        
        $params = $request->only(
            'number',
            'space',
            'rooms',
            'price',
            'description',
            'additional_phone',
            'status_id',
            'apartmentStatus_id',
            'floor_id',
        );
        $m->number = $params['number'];
        $m->space = $params['space'];
        $m->rooms = $params['rooms'];
        $m->price = $params['price'];
        $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->apartmentStatus_id = $params['apartmentStatus_id'];
        $m->floor_id = $params['floor_id'];
        $m->save();



        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        }else{
            
            if($request->hidden_image == 0)
            $m->image = null;
        }
        $m->save();
        $advantage_names = $request->input('advantage_names');
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
                    'image' => $img,
                ];
            }
        }
        $m->advantage_values = $storedAdvantage;

        $m->save();
        
        return redirect()->route('floor.edit', $m->floor_id);
        // return redirect()->route('apartment.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $apartment = Apartment::findOrFail($id);
        
        return view('cms.apartment.edit', [
            'apartment' => $apartment,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $apartment = Apartment::findOrFail($id);        
        return response()->json(['view' => view('cms.apartment.edit-ajax', compact('apartment'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Apartment::query()->find($id);
        
        $params = $request->only(
            'number',
            'space',
            'rooms',
            'price',
            'description',
            'floor_id',
            'status_id',
            'apartmentStatus_id',
           
        );
        $m->update($params);
        $m->save();
        // types
        
        $m->save();
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        }else{
            
            if($request->hidden_image == 0)
            $m->image = null;
        }
        $m->save();
        $advantage_names = $request->input('advantage_names');
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
                    'image' => $img,
                ];
            }
        }
        $m->advantage_values = $storedAdvantage;

        $m->save();


        return redirect()->route('floor.edit', $m->floor_id);
        // return redirect()->route('apartment.index');
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
        Apartment::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $apartment = Apartment::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($apartment, $f, $apartment->name, 'apartmentes');

            return $res;
        } else {
            return $this->uploadImageTrait($apartment, $file, $apartment->name, 'apartmentes');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $apartment = Apartment::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($apartment, $file)]);
    }

    public function getGallery($id)
    {
        $apartment = Apartment::query()->findOrFail($id);

        return $this->getFilesImageTrait($apartment);
    }
}
