<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ProjectCategory;
use Illuminate\Http\Request;

class ProjectCategoryController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ProjectCategory());
    }
}
