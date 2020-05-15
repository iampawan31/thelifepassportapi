<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware(['auth', 'verified']);
    }

    public function employerbefefits() {
        $employer_benefits = \App\EmployerBenefitsMaster::where('status', '1')->get();

        return response()->json(['status' => 200, 'data' => $employer_benefits], 200);
    }
}
