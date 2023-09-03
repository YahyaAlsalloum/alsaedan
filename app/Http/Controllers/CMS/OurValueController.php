<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OurValue;
use Illuminate\Http\Request;

class OurValueController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new OurValue());
    }
}
