<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Intervention\Image\Facades\Image;

class MultiControllerNoAction extends Controller
{
    protected $module;
    protected $validationRules;

    public function __construct($model)
    {
        $this->compacts = [
            'title' => $model->title,
            'permission' => $model->permission,
            'fields' => $model->fields,
            'route' => route($model->route.'.index'),
            'new' => route($model->route.'.create')
        ];
        $rules = [];
        foreach ($model->formFields as $name => $field){
            if ( Arr::has($field , 'rules') )
            $rules[$name] =   $field['rules'];
        }
        $this->validationRules = $rules;
        $this->module = $model;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        if ($request->ajax()) {
            
            $baseRoute = $this->compacts['route'];
            return $this->module->renderDataTable($this->module::query(), null, $baseRoute);
        }
        return view('cms.layouts.resources.index-without-actions', $this->compacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $form = $this->module->renderForm(route($this->module->route.'.store'));
        return view('cms.layouts.resources.create', compact('form'), ['title' => $this->compacts['title'],
            'route' => $this->module->route]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, $this->validationRules);
        $allParams = $request->except('_method', '_token');
        $params = [];

        foreach ( $this->module->formFields as $key =>$value ){
            if ( ( $value['insertion_type'] == 'belongsTo' || $value['insertion_type'] == 'field')
                && Arr::has($allParams , $key) ){
                if( !$request->hasFile($key))
                    $params[$key] = $allParams[$key];
            }
        }
        
        $m = $this->module::query()->create($params);

        foreach ( $this->module->formFields as $key =>$value ){
            if( $value['insertion_type'] == 'belongsToMany'){
                if (  Arr::has($allParams , $key))
                $m->{$value['pivot_reference']}()->attach($allParams[$key]);
            }
            
            if ($value['insertion_type'] == 'field_check') {
                if (Arr::has($allParams, $key)) {
                    if ($allParams[$key] == "on") {
                        $m->$key = true;
                    }
                } else {
                    $m->$key =  false;
                }
            }


        }
        
        $m->save();
        $m->slug = Str::slug($m->name);
        $m->save();
        $files = $request->files;
        foreach ( $files as $k => $file ){
            $title = class_basename($m).'/'.Str::slug($m->name).time().'.'.$file->getClientOriginalExtension();
            if ( !Storage::disk('public')->exists(class_basename($m))){
                Storage::disk('public')->makeDirectory(class_basename($m));
            }
            Storage::disk('public')->put($title, file_get_contents($file));
            $m->$k = 'storage/'.$title;
        }
        $m->save();
        return redirect()->route($this->module->route.'.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = $this->module->renderForm(route($this->module->route.'.update', $id), $id, 1);
        return view('cms.layouts.resources.show', compact('form'), ['title' => $this->compacts['title'],'route' => $this->module->route]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = $this->module->renderForm(route($this->module->route.'.update', $id), $id);
        return view('cms.layouts.resources.edit', compact('form'), ['title' => $this->compacts['title'],'route' => $this->module->route]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
//        $this->checkPermissionWithAbort(session('permissions',[]),$this->compacts['permission'],'modify');

//        $this->validate($request, $this->validationRules);
        $allParams = $request->except('_method', '_token');
        $params = [];
        $m = $this->module::query()->findOrFail($id);

        foreach ( $this->module->formFields as $key =>$value ){

            if (($value['insertion_type'] == 'belongsTo' || $value['insertion_type'] == 'field')
            && Arr::has($allParams, $key)) {
                if (!$request->hasFile($key)) {
                    $m->$key = $allParams[$key];
                }
            }

            if( $value['insertion_type'] == 'belongsToMany'){
                $m->{$value['pivot_reference']}()->detach();
                if ( Arr::has($allParams , $key))
                    $m->{$value['pivot_reference']}()->attach($allParams[$key]);
            }
            if( $value['insertion_type'] == 'field_check'){
                if(Arr::has($allParams, $key)){
                    if ($allParams[$key] == "on") {
                        $m->$key = $allParams[$key] = true;
                    }
                }
                else{
                    $m->$key = $allParams[$key] = false;
                }
            }

        }
        $m->save();

        $m->slug = Str::slug($m->name);
        $m->save();
        $files = $request->files;
        foreach ( $files as $k => $file ){
            
            $title = class_basename($m).'/'.Str::slug($m->name).time().'.'.$file->getClientOriginalExtension();
            if ( !Storage::disk('public')->exists(class_basename($m))){
                Storage::disk('public')->makeDirectory(class_basename($m));
            }
            Storage::disk('public')->put($title,  file_get_contents($file));
            $m->$k = 'storage/'.$title;
        }
        $m->save();

        return redirect()->route($this->module->route.'.index');
    }

    public function destroy($id)
    {
        $this->module::destroy($id);
    }


}
