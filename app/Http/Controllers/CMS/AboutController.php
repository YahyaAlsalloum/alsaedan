<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class AboutController extends MultiController
{
    
    public function __construct()
    {
        parent::__construct(new About());
    }
    public function index(Request $request)
    {
        $about = About::query()->first();
        if($about == null){
            $about = new About();
            $about->save();
        }
        return redirect()->route('about.edit',$about->_id);
    }
    public function edit($id)
    {
        $about = About::findOrFail($id);
        return view('cms.about.edit', compact('about'));
    }
    
    public function update(Request $request, $id)
    {
        $m = About::query()->find($id);
        $params = $request->only(
            'about_us',
            'our_vision',
            'our_message',
            'our_identity',
           
        );
        $m->update($params);
        $m->save();
     
        if ($request->has("about_image")) {
            $f = $request->file("about_image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->about_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_about_image == 0)
            $m->about_image = null;
        }
        $m->save();
        if ($request->has("vision_image")) {
            $f = $request->file("vision_image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->vision_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_vision_image == 0)
            $m->vision_image = null;
        }
        $m->save();
        if ($request->has("message_image")) {
            $f = $request->file("message_image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->message_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_message_image == 0)
            $m->message_image = null;
        }
        $m->save();
        if ($request->has("identity_image")) {
            $f = $request->file("identity_image");
            $title = 'apartmentes/' . Str::slug($m->name) . time() . rand() . '.' . $f->getClientOriginalExtension();
            if (!Storage::disk('public')->exists('apartmentes')) {
                Storage::disk('public')->makeDirectory('apartmentes');
            }
            Storage::disk('public')->put($title, file_get_contents($f));
            $m->identity_image = 'storage/' . $title;
        }else{
            
            if($request->hidden_identity_image == 0)
            $m->identity_image = null;
        }
        $m->save();
        return redirect()->route('about.edit',$m->_id);
    }


}
