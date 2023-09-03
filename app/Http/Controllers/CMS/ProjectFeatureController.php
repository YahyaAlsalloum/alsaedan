<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ProjectFeature;
use Illuminate\Http\Request;

class ProjectFeatureController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ProjectFeature());
    }
}
