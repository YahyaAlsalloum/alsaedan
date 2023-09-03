<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ServiceCategory;
use Illuminate\Http\Request;

class ServiceCategoryController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ServiceCategory());
    }
}
