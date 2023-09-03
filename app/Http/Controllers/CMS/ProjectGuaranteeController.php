<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ProjectGuarantee;
use Illuminate\Http\Request;

class ProjectGuaranteeController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new ProjectGuarantee());
    }
}
