<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\AboutInfo;
use Illuminate\Http\Request;

class AboutInfoController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new AboutInfo());
    }
}
