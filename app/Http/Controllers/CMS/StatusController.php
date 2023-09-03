<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Status;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    public function __construct()
    {
        $this->compacts = [
            'title' => 'STATUSES',
            'fields' => (new Status)->fields,
            'route' => route('status.index'),
            'new' => route('status.create')
        ];
        $this->validationRules = [
            'name' => 'required|unique:statuses,name',
            'name_ar' => 'required|unique:statuses,name_ar',
            'color' => 'required|starts_with:#',
        ];
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $status = new Status();
        if ($request->ajax()) {
            $baseRoute = route('status.index');
            return $status->renderDataTable(Status::query(), null, $baseRoute);
        }

        return view('cms.layouts.resources.index', $this->compacts);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        $status = new Status();
        $form = $status->renderForm(route('status.store'));
        return view('cms.layouts.resources.create', compact('form'), ['title' => $this->compacts['title'],'route'=>'status']);
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
        $params = $request->except('_method', '_token');
        Status::query()->create($params);
        return redirect()->route('status.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $form = (new Status)->renderForm(route('status.update', $id), $id, 1);
        return view('cms.layouts.resources.show', compact('form'), ['title' => $this->compacts['title'],'route'=>'status']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $form = (new Status)->renderForm(route('status.update', $id), $id);
        return view('cms.layouts.resources.edit', compact('form'), ['title' => $this->compacts['title'],'route'=>'status']);
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
        $this->validationRules['name'] .= ',' . $id;
        $this->validate($request, $this->validationRules);
        $params = $request->except('_method', '_token');
        Status::query()->findOrFail($id)->update($params);
        return redirect()->route('status.index');
    }

    public function destroy($id)
    {
        $status = Status::query()->find($id);
        Status::destroy($id);
    }
}
