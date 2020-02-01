<?php

namespace App\Http\Controllers\Api;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Exception;

class PersonalStepsController extends Controller
{
    /**
     * Update Personal Steps Information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $user = User::find(auth()->id());

            $user->steps()->sync([
                'step_id' => request('step_id') ?: false,
                'is_visited' => request('is_visited') ?: false,
                'is_filled' => request('is_filled') ?: false
            ]);

            return response()->json([
                'status' => 200,
                'msg' => 'Step information saved successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => $e
            ], 500);
        }
    }
}
