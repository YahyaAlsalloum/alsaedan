<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RoleController extends Controller
{
    public function __construct()
    {
        $this->compacts = [
            'title' => 'ROLES',
            'fields' => (new Role)->fields,
            'route' => route('role.index'),
            'new' => route('role.create')
        ];
        $this->validationRules = [
            'name' => 'required',
        ];

        $countries = Country::all();
        $country_permissions = [];
        $country_permissions ['label'] = 'Countries';
        $country_permissions ['list'] []= ['label'=>'All Countries','rule'=>'all'];
        foreach ($countries as $country ){
            $country_permissions['list'] [] = ['label'=>$country->name,'rule'=>$country->_id];
        }
        $permissions = [];
        $permissions['dashboard']['label']='Display Dashboard';
        $permissions['dashboard']['id']=1000;
        $permissions['dashboard']['rule']=['read'];
        $permissions['dashboard']['route']= route('dashboard');

        $permissions ['management']['label'] = 'Management';
        $permissions ['management']['list']['content']['label'] = 'Contents';
        $permissions ['management']['list']['content']['list']['website']['label'] = 'Website';
        $permissions ['management']['list']['content']['list']['website']['list']['home']['label'] = 'Home';
        $permissions ['management']['list']['content']['list']['website']['list']['home']['id']=1001;
        $permissions ['management']['list']['content']['list']['website']['list']['home']['rule'] = ['read','modify'];
        $permissions ['management']['list']['content']['list']['website']['list']['home']['route'] = route('home.index');

        $permissions ['management']['list']['document']['list']['terms-conditions']['label'] = 'Terms & Conditions';
        $permissions ['management']['list']['document']['list']['terms-conditions']['id']=1014;
        $permissions ['management']['list']['document']['list']['terms-conditions']['rule'] = ['read','modify'];
        $permissions ['management']['list']['document']['list']['terms-conditions']['route'] = route('getStatic','terms');

        $permissions ['management']['list']['document']['list']['privacy-policy']['label'] = 'Privacy Policy';
        $permissions ['management']['list']['document']['list']['privacy-policy']['id']=1015;
        $permissions ['management']['list']['document']['list']['privacy-policy']['rule'] = ['read','modify'];
        $permissions ['management']['list']['document']['list']['privacy-policy']['route'] = route('getStatic','privacy');

        $permissions ['management']['list']['country'] ['label'] = 'Country';


        $permissions ['management']['list']['businesses']['label'] = 'Businesses';
        $permissions ['management']['list']['businesses']['id']=1025;
        $permissions ['management']['list']['businesses']['rule'] = ['read','modify','bank'];
       // $permissions ['management']['list']['businesses']['route'] = route('business.index');

        $permissions ['management']['list']['users']['label'] = 'Users';
        $permissions ['management']['list']['users']['id']=1026;
        $permissions ['management']['list']['users']['rule'] = ['read','modify'];
        $permissions ['management']['list']['users']['route'] = route('user.index');


        $permissions ['management']['list']['roles']['label'] = 'Roles';
        $permissions ['management']['list']['roles']['id']=1028;
        $permissions ['management']['list']['roles']['rule'] = ['read','modify'];
        $permissions ['management']['list']['roles']['route'] = route('role.index');

        $permissions ['management']['list']['payment']['label'] = 'Payments';
        $permissions ['management']['list']['payment']['id']=1029;
        $permissions ['management']['list']['payment']['rule'] = ['read'];
        $permissions ['management']['list']['payment']['route'] = '';

        $permissions ['management']['list']['reports']['label'] = 'Reports';
        $permissions ['management']['list']['reports']['id']=1030;
        $permissions ['management']['list']['reports']['rule'] = ['read'];
        $permissions ['management']['list']['reports']['route'] = '';



        $this->cmsPermissions = $permissions;
        $this->countryPermissions = $country_permissions;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $country = new Role();
        if ($request->ajax()) {
            return $country->renderDataTable(Role::query()->whereNull('business_id')->whereNotIn('slug',['dev','admin','business-owner']));
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
        return view('cms.role.create',   ['title' => $this->compacts['title'],'route'=>'role',
            'permissions'=>$this->cmsPermissions,'country_permissions'=> $this->countryPermissions]);
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
        Role::query()->create($params);
        return redirect()->route('role.index');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $form = (new Role)->renderForm(route('role.update', $id), $id, 1);
        return view('cms.layouts.resources.show', compact('form'), ['title' => $this->compacts['title'],'route'=>'role']);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $role = Role::query()->find($id);
        return view('cms.role.edit', compact('role'), ['title' => $this->compacts['title'],'route'=>'role',
            'permissions'=>$this->cmsPermissions,'country_permissions'=> $this->countryPermissions]);
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
        $this->validate($request, $this->validationRules);
        $params = $request->except('_method', '_token');

        Role::query()->findOrFail($id)->update($params);
        return redirect()->route('role.index');
    }

    public function destroy($id){
        Role::query()->findOrFail($id)->delete();
    }
}
