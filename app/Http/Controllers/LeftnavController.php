<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;

class LeftnavController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personal.personal');
    }

    public function getpersonalinfoleftnavigation() {

        $user_id = Auth::user()->id;
        $objPersonalInfoSteps = \App\PersonalDetailsSteps::orderBy('sequence', 'ASC')->get();
        $data = [];

        if ($objPersonalInfoSteps->count()) {
            foreach( $objPersonalInfoSteps as $leftnav ) {
                
                //get details of each steps filled by user
                $is_visited = 0;
                $is_filled = 0;
                $is_completed = 0;
                $updated_at = "";

                $objStepFilledInfo = \App\UsersPersonalDetailsCompletion::where('user_id', $user_id)->where('step_id', $leftnav->id)->get();
                
                if($objStepFilledInfo->count() > 0) {
                    $is_visited = $objStepFilledInfo[0]->is_visited;
                    $is_filled = $objStepFilledInfo[0]->is_filled;
                    $is_completed = $objStepFilledInfo[0]->is_completed;
                    $updated_at = date('m.d.Y', strtotime($objStepFilledInfo[0]->updated_at));
                }

                $data[$leftnav->slug] = [
                            'id'            => $leftnav->id, 
                            'step'          => $leftnav->step, 
                            'slug'          => $leftnav->slug, 
                            'percentage'    => $leftnav->percentage, 
                            'sequence'      => $leftnav->sequence,
                            'is_visited'    => $is_visited,
                            'is_filled'     => $is_filled,
                            'is_completed'  => $is_completed,
                            'updated_at'    => $updated_at
                        ];
            }
        }



        return response()->json(['leftmenu' => $data]);
    }
}
