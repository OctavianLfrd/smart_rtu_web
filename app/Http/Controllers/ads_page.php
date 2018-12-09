<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ads_page extends Controller
{
    public function __invoke () {
        return view("view_ads");
    }
}
