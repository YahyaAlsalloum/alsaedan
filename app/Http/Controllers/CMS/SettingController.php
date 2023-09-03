<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class SettingController extends MultiController
{
    
    public function __construct()
    {
        parent::__construct(new Setting());
    }
    public function index(Request $request)
    {
        $setting = Setting::query()->first();
        if($setting == null){
            $setting = new Setting();
            $setting->save();
        }
        return redirect()->route('setting.edit',$setting->_id);
    }
    public function edit($id)
    {
        $setting = Setting::findOrFail($id);
        return view('cms.setting.edit', compact('setting'));
    }
    
    public function update(Request $request, $id)
    {
        $m = Setting::query()->find($id);
        $params = $request->only(
            'contact_phone',
            'contact_email',
            'contact_website',
            'opening_hours',
            'address',
            'linkedin',
            'twitter',
            'instagram',
            'facebook',
           
        );
        $m->update($params);
        $m->save();
     
        $m->location = [(float)$request->input('address_latitude'), (float)$request->input('address_longitude')];
        $m->save();

        return redirect()->route('setting.edit',$m->_id);
    }


}
