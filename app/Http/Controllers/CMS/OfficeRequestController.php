<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OfficeRequest;
use Illuminate\Http\Request;

class OfficeRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new OfficeRequest());
    }
}
