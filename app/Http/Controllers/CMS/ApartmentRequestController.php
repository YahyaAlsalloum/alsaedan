<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ApartmentRequest;
use Illuminate\Http\Request;

class ApartmentRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new ApartmentRequest());
    }
}
