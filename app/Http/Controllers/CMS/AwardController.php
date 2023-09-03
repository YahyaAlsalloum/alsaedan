<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Award;
use Illuminate\Http\Request;

class AwardController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Award());
    }
}
