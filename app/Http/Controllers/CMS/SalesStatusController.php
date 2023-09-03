<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\SalesStatus;
use Illuminate\Http\Request;

class SalesStatusController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new SalesStatus());
    }
}
