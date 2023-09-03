<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\ContactRequest;
use Illuminate\Http\Request;

class ContactRequestController extends MultiControllerNoAction
{
    //
    public function __construct()
    {
        parent::__construct(new ContactRequest());
    }
}
