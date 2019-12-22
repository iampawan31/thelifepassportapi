<?php

namespace App\Http\Controllers;

use App\Countries;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $arrCountries = \App\Countries::select('id', 'country_name as text')->toArray();
        //$arrCountries = collect($arrCountries)->map(function($x){ return (array) $x; })->toArray(); 
        return response()->json(['countries' => $arrCountries]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(Countries $personalInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Countries $personalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Countries $personalInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Countries $personalInfo)
    {
        //
    }

    public function personaldetails()
    {
        
    }
}
