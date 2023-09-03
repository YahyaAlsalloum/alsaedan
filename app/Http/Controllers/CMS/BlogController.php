<?php

namespace App\Http\Controllers\CMS;

use App\Http\Controllers\Controller;
use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends MultiController
{
    //
    public function __construct()
    {
        parent::__construct(new Blog());
    }
}
