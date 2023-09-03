<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Plot;
use App\Models\Floor;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class PlotController extends Controller
{
    
    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Plot();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('plot.index'),
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
        $this->compacts['route'] = route('plot.index');
        $plot = new Plot();
        $innerTable = false;
        if ($request->ajax()) {
            $baseRoute = route('plot.index');
            $query = Plot::query();
            if($request->has('land_id')){
                $innerTable = true;
                $aQuery = $request->input('land_id');
                $query = $query->where('land_id', $aQuery);
            }
            return $plot->renderDataTable($query, null, $baseRoute , $innerTable);
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create(Request $request)
    {

          
        $land_id = null;
        if($request->has('land_id')){
            
            $land_id = $request->input('land_id');
        }
        return view('cms.plot.create', [
            'title' => $this->compacts['title'],
            'land_id' => $land_id,
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Plot();
         
        $params = $request->only(
            'number',
            'space',
            'price',
            'additional_phone',
            'status_id',
            'description',
            'apartmentStatus_id',
            'land_id'
        );
        $m->number = $params['number'];
        $m->space = $params['space'];
        $m->price = $params['price'];
        $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->apartmentStatus_id = $params['apartmentStatus_id'];
        $m->land_id = $params['land_id'];
        $m->save();



        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'plotes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('plotes')) {
                Storage::disk('public')->makeDirectory('plotes');
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
        
        return redirect()->route('land.edit', $m->land_id);
        // return redirect()->route('plot.index');

    }

    public function edit(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $plot = Plot::findOrFail($id);
        
        return view('cms.plot.edit', [
            'plot' => $plot,
        ],
            $this->compacts
        );
    }
    public function editAjax(Request $request, $id)
    {
        // $active = Status::query()->where('slug', 'active')->first()->_id;
        $plot = Plot::findOrFail($id);        
        return response()->json(['view' => view('cms.plot.edit-ajax', compact('plot'))->render()]);

    }


    public function update(Request $request, $id)
    {
        $m = Plot::query()->find($id);
        
        $params = $request->only(
            'number',
            'space',
            'rooms',
            'price',
            'description',
            'land_id',
            'status_id',
            'apartmentStatus_id',
           
        );
        $m->update($params);
        $m->save();
        // types
        
        $m->save();
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'plotes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('plotes')) {
                Storage::disk('public')->makeDirectory('plotes');
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


        return redirect()->route('land.edit', $m->land_id);
        // return redirect()->route('plot.index');
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
        Plot::query()->findOrFail($id)->delete();
    }
    
    public function uploadImage(Request $request, $id)
    {
        $plot = Plot::query()->findOrFail($id);

        $file = $request->file('file');
        $res = [];

        if (is_array($file)) {
            foreach ($file as $f)
                $res [] = $this->uploadImageTrait($plot, $f, $plot->name, 'plotes');

            return $res;
        } else {
            return $this->uploadImageTrait($plot, $file, $plot->name, 'plotes');
        }
    }

    public function removeImage(Request $request, $id)
    {
        $plot = Plot::query()->findOrFail($id);
        $file = $request->input('file');

        return response()->json(['status' => $this->removeImageTrait($plot, $file)]);
    }

    public function getGallery($id)
    {
        $plot = Plot::query()->findOrFail($id);

        return $this->getFilesImageTrait($plot);
    }
}
