<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Exception;

class PersonalStepsController extends Controller
{
    /**
     * Update Personal Steps Information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        try {
            $user = User::find(auth()->id());

            $user->steps()->updateOrCreate([
                'step_id' => request('step_id') ?: 0,
                'is_visited' => request('is_visited') ?: 0,
                'is_filled' => request('is_filled') ?: 0
            ]);;

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
