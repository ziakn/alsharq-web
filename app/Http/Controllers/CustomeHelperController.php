<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Helper;
class CustomeHelperController extends Controller
{
    public function index(Request $request)
    {
        $data = Helper::customData();

        return $data;
     
    }
}
