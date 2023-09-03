<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\VillaRequest;
use Illuminate\Http\Request;

class VillaRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new VillaRequest());
    }
}
