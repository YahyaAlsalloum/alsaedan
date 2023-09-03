<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\OurGoal;
use Illuminate\Http\Request;

class OurGoalController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new OurGoal());
    }
}
