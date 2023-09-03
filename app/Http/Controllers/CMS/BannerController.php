<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;

use App\Models\Status;
use App\Models\Banner;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Utils\GalleryTrait;


class BannerController extends Controller
{

    use GalleryTrait;

    protected $module;
    protected $validationRules;

    public function __construct()
    {
        $model = new Banner();
        $this->compacts = [
            'title' => $model->title,
            'fields' => $model->fields,
            'route' => route('banner.index'),
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
            return $this->module->renderDataTable($this->module::query(), [], route('banner.index'));
        }
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create()
    {

        return view('cms.banner.create', [

            'title' => $this->compacts['title'],
        ], $this->compacts);
    }

    public function store(Request $request)
    {
        $m = new Banner();
        $this->validate($request, [
            'name' => 'required|unique:banners',
        ]);
        $params = $request->only(
            'name',
            'slogan',
            // 'description',
            'status_id',
            'location',
        );
        $m->name = $params['name'];
        $m->slug = Str::slug($m->name);
        $m->slogan = $params['slogan'];
        // $m->description = $params['description'];
        $m->status_id = $params['status_id'];
        $m->location = $params['location'];
        $m->save();


        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'banneres/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('banneres')) {
                Storage::disk('public')->makeDirectory('banneres');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        } else {
            if ($request->hidden_image == 0)
                $m->image = null;
        }
        $m->save();



        return redirect()->route('banner.index');
    }

    public function edit(Request $request, $id)
    {
        $banner = Banner::findOrFail($id);
        return view(
            'cms.banner.edit',
            [
                'banner' => $banner,
            ],
            $this->compacts
        );

    }


    public function update(Request $request, $id)
    {
        
        $m = Banner::query()->find($id);
        
        $params = $request->only(
            'name',
            'slogan',
            // 'description',
            'status_id',
            'location',
        );
        $m->update($params);
        
        // $m->slug = Str::slug($m->name);
        $m->save();
        

        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'banneres/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('banneres')) {
                Storage::disk('public')->makeDirectory('banneres');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        } else {

            if ($request->hidden_image == 0)
                $m->image = null;
        }
        $m->save();

        return redirect()->route('banner.index');
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
        Banner::query()->findOrFail($id)->delete();
    }


}
