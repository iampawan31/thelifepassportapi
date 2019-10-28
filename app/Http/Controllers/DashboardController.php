<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //dd(Auth::User());
        return view('dashboard.index');
    }

    public function personalinfo(Request $request) {
        return view('dashboard.personalinfo');
    }

    public function personaldetails(Request $request) {
        return view('dashboard.personaldetails');
    }
}
