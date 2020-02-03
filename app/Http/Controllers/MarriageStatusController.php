<?php

namespace App\Http\Controllers;

use Exception;
use App\MarriageStatus;
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
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $marriageStatus = MarriageStatus::updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'is_married' => request('is_married') == 'true' ? '1' : '0'
            ]);
            
            if (request('is_married') == "0") {
                $is_completed = '1';
                // auth()->user()->steps()->sync([
                //     'user_id' => auth()->id(),
                //     'step_id' => 2,
                //     'is_visited' => true,
                //     'is_filled' => true,
                //     'is_completed' => true
                // ]);
            } else {
                $is_completed = '0';
                // auth()->user()->steps()->sync(['user_id' => auth()->id(),
                //     'step_id' => 2,
                //     'is_visited' => true,
                //     'is_filled' => true,
                //     'is_completed' => false
                // ]);
            }

            UsersPersonalDetailsCompletion::updateOrCreate(
                ['user_id' => auth()->id(), 'step_id' => 2], 
                [
                    'is_visited'    => '1',
                    'is_filled'     => '1',
                    'is_completed'  => $is_completed
                ]
            );


            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Marriage status updated successfully'
                ], 201);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e]);
        }
    }
}
