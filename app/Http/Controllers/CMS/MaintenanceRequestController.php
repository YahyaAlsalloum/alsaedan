<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\MaintenanceRequest;
use Illuminate\Http\Request;

class MaintenanceRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new MaintenanceRequest());
    }
}
