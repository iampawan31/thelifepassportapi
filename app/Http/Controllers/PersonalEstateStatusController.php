<?php

namespace App\Http\Controllers;

use App\PersonalEstateStatus;
use Illuminate\Http\Request;

class PersonalEstateStatusController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $personalEstateStatus = PersonalEstateStatus::firstOrCreate(['user_id' => auth()->id()]);

            $personalEstateStatus->has_personal_estate = request('has_personal_estate');
            $personalEstateStatus->save();

            auth()->user()->steps()->syncWithoutDetaching([7 => [
                'is_visited' => '1',
                'is_filled' => '1',
                'is_completed' => $personalEstateStatus ? 1 : 0
            ]]);

            return response()->json(['status' => 201, 'message' => 'Family Status updated successfully'], 201);

        } catch (\Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception], 500);
        }
    }
}
