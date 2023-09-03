<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Villa;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class VillaController extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Villa();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('villa.index'),
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
        $this->compacts['route'] = route('villa.index');
        $villa = new Villa();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('villa.index');
            $query = Villa::query();
            if($request->has('realestate_id')){
                $innerTable = true;
                $aQuery = $request->input('realestate_id');
                $query = $query->where('realestate_id', $aQuery);
            }
            return $villa->renderDataTable($query, null, $baseRoute , $innerTable);
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create(Request $request)
    {

          
        $realestate_id = null;
        if($request->has('realestate_id')){
            
            $realestate_id = $request->input('realestate_id');
        }
        return view('cms.villa.create', [
            'title' => $this->compacts['title'],
            'realestate_id' => $realestate_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Villa();
        
        $params = $request->only(
            'number',
            'space',
            'rooms',
            'price',
            'description',
            'additional_phone',
            'status_id',
            'villaStatus_id',
            'realestate_id',
        );
        $m->number = $params['number'];
        $m->space = $params['space'];
        $m->rooms = $params['rooms'];
        $m->price = $params['price'];
        $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->villaStatus_id = $params['villaStatus_id'];
        $m->realestate_id = $params['realestate_id'];
        $m->save();



        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'villaes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('villaes')) {
                Storage::disk('public')->makeDirectory('villaes');
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
        
        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('villa.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $villa = Villa::findOrFail($id);
        
        return view('cms.villa.edit', [
            'villa' => $villa,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $villa = Villa::findOrFail($id);        
        return response()->json(['view' => view('cms.villa.edit-ajax', compact('villa'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Villa::query()->find($id);
        
        $params = $request->only(
            'number',
            'space',
            'rooms',
            'price',
            'description',
            'realestate_id',
            'status_id',
            'villaStatus_id',
           
        );
        $m->update($params);
        $m->save();
        // types
        
        $m->save();
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'villaes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('villaes')) {
                Storage::disk('public')->makeDirectory('villaes');
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


        return redirect()->route('realestate.edit', $m->realestate_id);
        // return redirect()->route('villa.index');
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
        Villa::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $villa = Villa::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($villa, $f, $villa->name, 'villaes');

            return $res;
        } else {
            return $this->uploadImageTrait($villa, $file, $villa->name, 'villaes');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $villa = Villa::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($villa, $file)]);
    }

    public function getGallery($id)
    {
        $villa = Villa::query()->findOrFail($id);

        return $this->getFilesImageTrait($villa);
    }
}
