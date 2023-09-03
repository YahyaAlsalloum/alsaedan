<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ApartmentStatus;
use Illuminate\Http\Request;

class ApartmentStatusController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ApartmentStatus());
    }
}
