<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ProjectService;
use Illuminate\Http\Request;

class ProjectServiceController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ProjectService());
    }
}
