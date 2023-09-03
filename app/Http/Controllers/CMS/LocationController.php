<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Location());
    }
}
