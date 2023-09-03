<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\PlotRequest;
use Illuminate\Http\Request;

class PlotRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new PlotRequest());
    }
}
