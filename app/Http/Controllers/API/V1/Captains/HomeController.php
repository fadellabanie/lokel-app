<?php

namespace App\Http\Controllers\Api\V1\Captains;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class HomeController extends Controller
{
  
    public function home(Request $request)
    {
        //dd(Auth::user());
        dd($request->bearerToken());
    }
}