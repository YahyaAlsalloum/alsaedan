<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Service;
use Illuminate\Http\Request;

class ServiceController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Service());
    }
}
