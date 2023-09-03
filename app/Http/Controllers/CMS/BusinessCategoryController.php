<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\BusinessCategory;
use Illuminate\Http\Request;

class BusinessCategoryController extends MultiController
{
    
    //
    public function __construct()
    {
        parent::__construct(new BusinessCategory());
    }
}
