<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\SocialService;
use Illuminate\Http\Request;

class SocialServiceController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new SocialService());
    }
}
