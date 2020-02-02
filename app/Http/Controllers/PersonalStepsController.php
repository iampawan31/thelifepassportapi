<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\UsersPersonalDetailsCompletion;

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

            // $user->steps()->sync([
            //     'step_id' => request('step_id') ?: false,
            //     'is_visited' => request('is_visited') ?: false,
            //     'is_filled' => request('is_filled') ?: false
            // ]);

            UsersPersonalDetailsCompletion::updateOrCreate(
                ['user_id' => $user->id, 'step_id' => request('step_id')], 
                [
                    'is_visited' => request('is_visited') == 'true' ? '1' : '0',
                    'is_filled' => request('is_filled') == 'true' ? '1' : '0',
                    'is_completed' => request('is_completed') == "true" ? '1' : '0'
                ]
            );

            return response()->json([
                'status' => 201,
                'msg' => 'Step information saved successfully'
            ], 201);
        } catch (Exception $e) {dd($e);
            return response()->json([
                'status' => 500,
                'msg' => $e
            ], 500);
        }
    }
}
