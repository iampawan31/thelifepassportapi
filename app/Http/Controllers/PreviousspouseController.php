<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use Illuminate\Http\Request;

class PreviousspouseController extends Controller
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $inputs = $request->all();
        
        //previous spouse information
        $user_id            = Auth::user()->id;
        $legal_name         = $inputs['legal_name'];
        $marriage_date      = $inputs['marriage_date'];
        $marriage_location  = $inputs['marriage_location'];
        $divorce_date       = $inputs['divorce_date'];
        $divorce_location   = $inputs['divorce_location'];
        $email              = $inputs['email'];
        $is_alimony_paid    = @$inputs['owe_alimony'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => $user_id, 'phone' => $phone];
                }
            }
        }

        $arrPreviousSpouseInfo = [
            'user_id'           => $user_id,
            'legal_name'        => $legal_name ? $legal_name : "",
            'marriage_date'     => $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : "",
            'marriage_location' => $marriage_location ? $marriage_location : "",
            'divorce_date'      => $divorce_date ? date('Y-m-d', strtotime($divorce_date)) : "",
            'divorce_location'  => $divorce_location ? $divorce_location : "",
            'email'             => $email ? $email : "",
            'is_alimony_paid'   => $is_alimony_paid ? $is_alimony_paid : '0',
        ];

        try {
            //insert Previous Spouce information
            $objPreviousSpouseInfo = \App\PreviousSpouseInfo::create($arrPreviousSpouseInfo);

            // //insert record in user personal details completion
            // \App\UsersPersonalDetailsCompletion::where('step_id', 3)
            //                                     ->where('user_id', Auth::user()->id)
            //                                     ->update(['is_filled' => '1']);

            //insert previous spouse phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\PreviousSpousePhone::create($phones);
                } 
            }
            
            return response()->json(['status' => 200, 'message' => 'Previous Spouse information has been saved successfully']);
        } catch(Exception $e) {
            return response()->json(['status' => 503, 'message' => 'Error']);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = \App\PreviousSpouseInfo::where('user_id', $id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = \App\PreviousSpouseInfo::find($id)
                ->with('PreviousSpousePhone')
                ->get();
            
            return response()->json(['status' => 200, 'data' => $previous_spouse_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $inputs = $request->all();
        
        //personal information
        $user_id            = Auth::user()->id;
        $legal_name         = $inputs['legal_name'];
        $marriage_date      = $inputs['marriage_date'];
        $marriage_location  = $inputs['marriage_location'];
        $divorce_date       = $inputs['divorce_date'];
        $divorce_location   = $inputs['divorce_location'];
        $email              = $inputs['email'];
        $is_alimony_paid    = @$inputs['owe_alimony'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => $user_id, 'phone' => $phone];
                }
            }
        }

        try {
            //get previous spouse information
            $objPreviousSpouseInfo                      = \App\PreviousSpouseInfo::find($id);
            $objPreviousSpouseInfo->legal_name          = $legal_name ? $legal_name : "";
            $objPreviousSpouseInfo->marriage_date       = $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : "";
            $objPreviousSpouseInfo->marriage_location   = $marriage_location ? $marriage_location : "";
            $objPreviousSpouseInfo->divorce_date        = $divorce_date ? date('Y-m-d', strtotime($divorce_date)) : "";
            $objPreviousSpouseInfo->divorce_location    = $divorce_location ? $divorce_location : "";
            $objPreviousSpouseInfo->email               = $email ? $email : "";
            $objPreviousSpouseInfo->is_alimony_paid     = $is_alimony_paid ? $is_alimony_paid : '0';

            // //insert record in user personal details completion
            // \App\UsersPersonalDetailsCompletion::where('step_id', 3)
            //                                     ->where('user_id', Auth::user()->id)
            //                                     ->update(['is_filled' => '1']);

            //insert previous spouse phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\PreviousSpousePhone::where('user_id', $user_id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\PreviousSpousePhone::create($phones);
                } 
            }
            
            return response()->json(['status' => 200, 'message' => 'Previous Spouse information has been saved successfully']);
        } catch(Exception $e) {
            return response()->json(['status' => 503, 'message' => 'Error']);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function getpreviousspouseinfo() {
        $user_id = Auth::user()->id;
        $count = \App\PreviousSpouseInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = \App\PreviousSpouseInfo::find($user_id)
                ->with('PreviousSpousePhone')
                ->get();
            
            return response()->json(['status' => 200, 'data' => $previous_spouse_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatemarriagestatus(Request $request) {
        $inputs = $request->all();
        
        $user_id    = Auth::user()->id;
        $is_married = $inputs['is_married'];

        try {
            //check for record
            $objMarriageStatus = \App\PreviousMarriageStatus::find($user_id);
            if ($objMarriageStatus) {
                $objMarriageStatus->is_previously_married = $is_married;
                $objMarriageStatus->save();
            } else {
                \App\PreviousMarriageStatus::create(['user_id' => $user_id, 'is_previously_married' => $is_married]);
            }

            return response()->json(['status' => 200, 'msg' => 'Marriage status has been updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'msg' => 'Error']);
        }
    }

    public function getpreviousmarriagestatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objMarriageStatus = \App\PreviousMarriageStatus::find($user_id);
            
            return response()->json(['status' => 200, 'data' => $objMarriageStatus]);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'data' => [[]]]);
        }
    }
}
