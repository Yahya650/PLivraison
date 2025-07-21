<?php

namespace App\Http\Controllers\v1\web;

use App\Http\Controllers\Controller;

class WebController extends Controller
{
    public function home()
    {
        return view('v1.web.pages.home.index');
    }
}
