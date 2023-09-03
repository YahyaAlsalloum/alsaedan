<?php

namespace App\Http\Controllers\CMS\Front;


use App\Http\Controllers\CMS\MultiController;
use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AboutController extends Controller
{
    //
//    public function __construct()
//    {
//        parent::__construct(new About());
//    }


    public function index()
    {
        $about = About::query()->first();
        if ($about == null)
            return $this->create();
        return $this->edit($about->id);
    }


    public function create(){
        return view('cms.front.about.create');
    }
    public function store(Request $request){
        $about = new About([
            'about' => $request->about,
            'email' => $request->email,
            'phone' => $request->phone,
            'address' => $request->address
        ]);
        $file = $request->file('image');
        $name = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('img')) {
            Storage::disk('public')->makeDirectory('img');
        }
        if (Storage::disk('public')->putFileAs('img', $file, $name)) {
            $about->image = 'img/' . $name;
        } else {
            return $this->index();
        }
        $about->save();
        return redirect()->route('about.index');
    }
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('cms.front.about.edit', compact('about'));
    }
    public function update(Request $request,$id){
        $about = About::findOrFail($id);
        $about->about  =  $request->about;
        $about->email  =  $request->email;
        $about->phone  =  $request->phone;
        $about->address  =  $request->address;
        $file = $request->file('image');
        $name = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
        if (!Storage::disk('public')->exists('img')) {
            Storage::disk('public')->makeDirectory('img');
        }
        if (Storage::disk('public')->putFileAs('img', $file, $name)) {
            $about->image = 'img/' . $name;
        } else {
            return $this->index();
        }
        $about->save();
        return redirect()->route('about.index');
    }
}

