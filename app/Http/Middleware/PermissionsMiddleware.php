<?php

namespace App\Http\Middleware;

use App\Models\Country;
use App\Models\Site;
use Closure;
use Exception;
use Illuminate\Http\Request;

class PermissionsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            if ( $request->ajax())
                return $next($request);
            $request->permissions = auth()->user()->role->permissions;
            $request->permission_name = auth()->user()->role->slug;
            if ( in_array(auth()->user()->role->slug,['dev','admin'] ) ){
                $countries = Country::all();
                $cp['all'] = 'on' ;
                foreach ( $countries as $c){
                    $cp [ $c->_id]='on';
                }
                $per ['country'] = $cp;
                $request->permissions= $per;
                session()->put('permissions', $request->permissions);
                session()->put('permission_name', auth()->user()->role->slug);
                return $next($request);
            }

            if ( in_array(auth()->user()->role->slug,['business-owner'] ) ){

                session()->put('permissions', $request->permissions);
                session()->put('permission_name', auth()->user()->role->slug);
                return $next($request);
            }
            session()->put('permissions', auth()->user()->role->permissions);
            session()->put('permission_name', auth()->user()->role->slug);

            $rules =   $request->permissions  ;
            foreach ($rules as $key => $values){
                foreach ( $values as $k => $v ){
                    if ( strtolower( $request->method()) == 'get'){

                        if ( $k == 'bank' && (route('admin.business.account-details',
                                    session()->get('selected_business','-1'))
                                == $request->fullUrl() ||
                                route('business.account-details',
                                    session()->get('selected_business','-1'))
                                == $request->fullUrl()
                            ) ){
                            return $next($request);
                        }
                        if ( $k == 'read' && $v == str_replace(asset('/'),'',$request->fullUrl())){
                            return $next($request);
                        }
                    }else{
                        if ( $k == 'modify' && $v == str_replace(asset('/'),'',$request->fullUrl())){
                            return $next($request);
                        }
                    }
                }
            }


        } catch (Exception $e) {
            $request->permissions = null;
        }
        abort(403);
    }

}
