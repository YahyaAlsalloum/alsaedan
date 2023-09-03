<?php

namespace App\Providers;

use Cookie;
use App\Models\Status;
use App\Models\BusinessCategory;
use App\Models\Setting;
use App\Models\ServiceCategory;
use App\Utils\PermissionHelper;
use Illuminate\Support\Arr;
use Illuminate\Support\ServiceProvider;


class FrontendGlobalTemplateServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // C:\Users\Hisham\Documents\laravel\alsaedan-new\resources\views\partials\home-header.blade.php
        view()->composer(['partials.home-header','partials.header'], function ($view) {
            $view->with('businessCategories', $this->businessCategories());
            $view->with('serviceCategories', $this->serviceCategories());
        });
        view()->composer(['partials.footer'], function ($view) {
            $view->with('setting', $this->setting());
        });

    }
    private function businessCategories(){
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $businessCategories = BusinessCategory::query()->where('status_id',$active)->get();
        return $businessCategories;
    }

    private function serviceCategories(){
        $active = Status::query()->where('slug', 'active')->first()->_id;
        $serviceCategories = ServiceCategory::query()->where('status_id',$active)->get();
        return $serviceCategories;
    }
    private function setting(){ 

        return Setting::query()->first();
    }


}
