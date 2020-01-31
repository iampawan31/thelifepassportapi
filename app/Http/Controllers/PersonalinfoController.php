<?php

namespace App\Http\Controllers;

use App\User;
use App\PersonalAddress;
use App\PersonalEmployerBenefits;
use Exception;
use App\PersonalInfo;
use App\UserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class PersonalInfoController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display the Personal Information Page.
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('personal.info', ['user' => auth()->user()]);
    }

    /**
     * Get Personal Information Details.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function show()
    {
        return response()->json(['status' => 200, 'data' => auth()->user()]);
    }
}
