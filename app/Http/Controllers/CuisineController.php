<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CuisineController extends Controller
{
    //
    public function index(Request $request)
    {
        $request->user()->authorizeRoles(['cook']);

    }
}
