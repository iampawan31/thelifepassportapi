<?php

namespace App\Http\Controllers;

use App\PersonalInfo;
use Illuminate\Http\Request;

class PersonalinfoController extends Controller
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
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personalinfo.personalinfo');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalInfo $personalInfo)
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
    public function update(Request $request, PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        //
    }
}
