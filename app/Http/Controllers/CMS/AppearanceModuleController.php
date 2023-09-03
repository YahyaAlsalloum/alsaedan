<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\AppearanceModule;
use Illuminate\Http\Request;

class AppearanceModuleController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new AppearanceModule());
    }
}
