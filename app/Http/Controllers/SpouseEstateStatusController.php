<?php

namespace App\Http\Controllers;

use App\SpouseEstateStatus;
use Illuminate\Http\Request;

class SpouseEstateStatusController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $spouseEstateStatus = SpouseEstateStatus::firstOrCreate(['user_id' => auth()->id()]);

            $spouseEstateStatus->has_spouse_estate = request('has_spouse_estate');
            $spouseEstateStatus->save();

            auth()->user()->steps()->syncWithoutDetaching([8 => [
                'is_visited' => '1',
                'is_filled' => '1',
                'is_completed' => $spouseEstateStatus ? 1 : 0
            ]]);

            return response()->json(['status' => 201, 'message' => 'Family Status updated successfully'], 201);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
