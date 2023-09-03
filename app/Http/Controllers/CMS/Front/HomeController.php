<?php

namespace App\Http\Controllers\CMS\Front;


use App\Http\Controllers\Controller;
use App\Models\Home;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class HomeController extends Controller
{
    //
    public function index()
    {
        $home = Home::query()->first();
        if ($home == null)
            return $this->create();
        return $this->edit($home->id);
    }

    public function create()
    {
        return view('cms.front.home.create');
    }

    public function store(Request $request)
    {
        $home = new Home([
            'title' => $request->title,
            'body' => $request->body,
            'appStore' => $request->appStore,
            'googlePlay' => $request->googlePlay,
        ]);
        $file = $request->file('image');
        $name = 'home_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('home')) {
            Storage::disk('public')->makeDirectory('home');
        }
        if (Storage::disk('public')->putFileAs('home', $file, $name)) {
            $home->image = 'home/' . $name;
        } else {
            return $this->index();
        }
        $home->save();
        return redirect()->route('home.index');
    }

    public function edit($id)
    {
        $home = Home::query()->first();
        return view('cms.front.home.edit', compact('home'));
    }

    public function update(Request $request, $id)
    {
        $home = Home::findOrFail($id);
        $home->title = $request->title;
        $home->body = $request->body;
        $home->appStore = $request->appStore;
        $home->googlePlay = $request->googlePlay;
        $file = $request->file('image');
        $name = 'home_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('home')) {
            Storage::disk('public')->makeDirectory('home');
        }
        if (Storage::disk('public')->putFileAs('home', $file, $name)) {
            $home->image = 'home/' . $name;
        } else {
            return $this->index();
        }
        $home->save();
        return redirect()->route('home.index');
    }
}
