<?php

namespace App\Http\Controllers;

use App\EmployerBenefitsMaster;
use Illuminate\Http\Request;

class BenefitController extends Controller
{
    public function index()
    {
        $benefits = EmployerBenefitsMaster::all();
        return response()->json(['data' => $benefits], 200);
    }
}
