<?php

namespace App\Http\Controllers\Api;

use App\MarriageStatus;
use App\UsersPersonalDetailsCompletion;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class MarriageStatusController extends Controller
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        try {
            $marriageStatus = MarriageStatus::updateOrCreate([
                'user_id' => auth()->id()
            ], [
                'is_married' => request('is_married')
            ]);

            if (request('is_married') == "0") {
                auth()->user()->steps()->sync([
                    'user_id' => auth()->id(),
                    'step_id' => 2,
                    'is_visited' => true,
                    'is_filled' => true,
                    'is_completed' => true
                ]);
            } else {
                auth()->user()->steps()->sync(['user_id' => auth()->id(),
                    'step_id' => 2,
                    'is_visited' => true,
                    'is_filled' => true,
                    'is_completed' => false
                ]);
            }

            return response()->json(['status' => 201, 'message' => 'Marriage status updated successfully'], 201);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e]);
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
