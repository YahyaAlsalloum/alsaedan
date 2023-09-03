<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Team;
use Illuminate\Http\Request;

class TeamController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Team());
    }
}
