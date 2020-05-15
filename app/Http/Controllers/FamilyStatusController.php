<?php

namespace App\Http\Controllers;

use Exception;
use App\FamilyStatus;
use Illuminate\Http\Request;

class FamilyStatusController extends Controller
{
    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        try {
            $familyStatus = FamilyStatus::where('user_id', auth()->id())->first();
            return response()->json(['status' => 200, 'data' => $familyStatus], 200);
        } catch (Exception $exception) {
            return response()->json(['status' => 500, 'message' => $exception], 500);
        }
    }

    /**
     * @return \Illuminate\Http\JsonResponse
     */
    public function store()
    {
        try {
            FamilyStatus::updateOrCreate(['user_id' => auth()->id()],
                ['has_family_member' => request('has_family_member')]);

            auth()->user()->steps()->syncWithoutDetaching([4 => [
                'is_visited' => 1,
                'is_filled' => 1,
                'is_completed' => request('has_family_member') ? 0 : 1
            ]]);

            return response()->json(['status' => 201, 'message' => 'Family Status updated successfully'], 201);

        } catch (\Exception $exception) {dd($exception);
            return response()->json(['status' => 500, 'message' => $exception], 500);
        }
    }
}
