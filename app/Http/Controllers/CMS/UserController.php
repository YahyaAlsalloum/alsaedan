<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;



class UserController extends Controller
{

    public function __construct()
    {
        $this->compacts = [
            'title' => 'USERS',
            'fields' => (new User)->fields,
            'route' => route('user.index'),
            'new' => route('user.create'),
        ];
    }

    public function index(Request $request)
    {
        $this->compacts['route'] = route('user.index');
        $user = new User();
        if ($request->ajax()) {
            $baseRoute = route('user.index');
            $query = User::query();
            if($request->has('aQuery')){
                $aQuery = $request->input('aQuery');
                // dd($aQuery);
            }
            return $user->renderDataTable($query, null, $baseRoute);
        }

        
        return view('cms.layouts.resources.index', $this->compacts);
    }

    public function create()
    {
        $form = (new User)->renderForm(route('user.store'));
        return view('cms.user.create', compact('form'), ['title' => $this->compacts['title']]);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email',
            'status_id' => 'required',
            'role_id' => 'required',
            // 'password' => 'required|confirmed|min:6',
        ]);

        $m = new User();
        $m->name = $request->input('name');
        $m->email = $request->input('email');
        $m->phone = $request->input('phone');
        $m->status_id = $request->input('status_id');
        $m->role_id = $request->input('role_id');
        $m->bio = $request->input('bio');
        $m->is_profile_completed = false;
        $m->has_password = false;

        
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'users/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('user');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        }else{
            
            if($request->hidden_image == 0)
            $m->image = null;
        }
        $m->save();

        
        return redirect()->route('user.index');
    }

    public function show($id)
    {
        $compact = ['title' => $this->compacts['title']];

        $form = (new User)->renderForm(route('user.update', $id), $id, 1,
            false, []);
        return view('cms.layouts.resources.show', compact('form'), $compact);
    }

    public function edit($id)
    {
        $user = User::query()->where('_id',$id)->first();
        return view('cms.user.edit', compact('user',), ['title' => $this->compacts['title'],'route'=>'user']);
    }

    public function update(Request $request, $id)
    {
        
        $this->validate($request, [
            'name' => 'required',
            'status_id' => 'required',
            'role_id' => 'required',
        ]);

        $params = $request->except('_method', '_token','image');
        $m = User::query()->findOrFail($id);
        $m->update($params);
        
        if ($request->has("image")) {
            $f = $request->file("image");
            $title = 'users/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('users')) {
                Storage::disk('public')->makeDirectory('user');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->image = 'storage/' . $title;
        }else{
            
            if($request->hidden_image == 0)
            $m->image = null;
        }
        $m->save();


        return redirect()->route('user.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
    }

    public function profile()
    {
        return view('cms.user.profile');
    }

    public function updateProfile(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,' . auth()->user()->id,
        ]);
        $params = $request->except('_token', '_method');

        auth()->user()->update($params);
        return view('cms.user.profile');
    }

    public function updatePassword(Request $request)
    {
        $this->validate($request, [
            'old_password' => 'required',
            'password' => 'required|confirmed',
        ]);
        if (Hash::check($request->old_password, auth()->user()->password)) {
            auth()->user()->update(['password' => bcrypt($request->password)]);
            return redirect()->back()->with('updated', true);
        }
        return redirect()->back()->with('updated', false);

    }

}
