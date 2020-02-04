<?php

namespace App\Http\Controllers;

use App\User;
use App\Http\Controllers\Controller;
use App\UsersPersonalDetailsCompletion;
use Illuminate\Http\Request;
use Exception;

class PersonalStepsController extends Controller
{
    /**
     * Update Personal Steps Information.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request)
    {
        try {
            $user = User::find(auth()->id());
            $stepId = $this->hasExistingStep($user);

            if ($stepId) {
                $user->steps()->syncWithoutDetaching(request('step_id'), [
                    'is_visited' => request('is_visited') ?: false,
                    'is_filled' => request('is_filled') ?: false,
                    'is_completed' => request('is_completed') ?: false
                ]);
            } else {
                $user->steps()->attach(request('step_id'), [
                    'is_visited' => request('is_visited') ?: false,
                    'is_filled' => request('is_filled') ?: false,
                    'is_completed' => request('is_completed') ?: false
                ]);
            }

            return response()->json([
                'status' => 201,
                'msg' => 'Step information saved successfully'
            ], 201);
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'msg' => $e
            ], 500);
        }
    }

    /**
     * @param $user
     * @return int
     */
    protected function hasExistingStep($user)
    {
        $stepId = UsersPersonalDetailsCompletion::where([
            'user_id' => $user->id,
            'step_id' => request('step_id')
        ])->first();
        return $stepId;
    }
}
