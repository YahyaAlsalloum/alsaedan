<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Country;
use App\Models\Role;
use App\User;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use ErrorException;
use Illuminate\Http\Request;

class CmsController extends Controller
{

    public function index(Request $request)
    {
        
        // dd($joiningByDate);
        return view('cms.dashboard.index',compact([

        ]));
    }


//total earning : gross amount
//total profit : net rebusiness : lustre

//get coins func
//wallets
// role user

//transactions per month 1-30



    public function ajaxSelectByModel(Request $request, $model)
    {
        if ( $model == 'User')
            $model = 'App\User';
        else $model = 'App\Models\\'.$model;

        $model = new $model();
        $data = $model::query();

        foreach ( $request->all()  as $key => $value ){
            if ( $key != '_type' && $key !='term')
            if ($key == 'q') {
                $data->where('name', 'like', '%' . $value . '%');
            } else if ($key == 'slug'){
                $data->whereIn('slug',explode(',',$value));
            }else{
                $data->where($key, $value);
            }
        }
        return json_encode($data->orderBy('name', 'asc')->get());
    }

    public function ajaxSelectCountries(Request $request)
    {

        $data =[];
        $permissions = session()->get('permissions');
        if ($permissions!= null && array_key_exists('country', $permissions)){
            $data = Country::query()
                ->whereIn('_id', array_keys($permissions['country']))
                ->orderBy('name','asc')->get()->toArray();
        }
        if ($permissions!= null && array_key_exists('country', $permissions)
            && array_key_exists('all', $permissions['country']))
            array_unshift($data,['_id'=>'all','name'=>'All Countries']);

        return json_encode($data);
    }

    

    public function storeMedia(Request $request)
    {
        $path = public_path('storage/tmp/uploads');

        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        $file = $request->file('file');

        $name = uniqid() . '_' . trim($file->getClientOriginalName());

        $file->move($path, $name);

        return response()->json([
            'name'          => $name,
            'original_name' => $file->getClientOriginalName(),
        ]);
    }



}
