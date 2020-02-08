<?php

namespace App\Http\Controllers;

use Exception;
use App\MarriageStatus;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\UsersPersonalDetailsCompletion;

class MarriageStatusController extends Controller
{
    public function index()
    {
        try {
            $marriage = MarriageStatus::where('user_id', auth()->id())->first();
            return response()->json(['data' => $marriage], 200);
        } catch (Exception $exception) {
            return response()->json(['data' => $exception], 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        if (request('is_married') == 2) {
            // TODO:: What happens here?
        } else {
            try {
                $marriageStatus = MarriageStatus::updateOrCreate([
                    'user_id' => auth()->id()
                ], [
                    'is_married' => request('is_married') ? 1 : 0
                ]);

                if (request('is_married')) {
                    auth()->user()->steps()->syncWithoutDetaching([2 => [
                        'is_visited' => 1,
                        'is_filled' => 1,
                        'is_completed' => 0
                    ]]);
                } else {
                    auth()->user()->steps()->syncWithoutDetaching([2 => [
                        'is_visited' => 1,
                        'is_filled' => 1,
                        'is_completed' => 1
                    ]]);
                }

                return response()
                    ->json([
                        'status' => 201,
                        'message' => 'Marriage status updated successfully'
                    ], 201);
            } catch (Exception $e) {
                return response()->json(['status' => 500, 'message' => $e], 500);
            }
        }
        return;
    }
}
