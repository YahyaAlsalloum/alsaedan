<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Manager;
use Illuminate\Http\Request;

class ManagerController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Manager());
    }
}
