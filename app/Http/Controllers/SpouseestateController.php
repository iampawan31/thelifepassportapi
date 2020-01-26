<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use Illuminate\Http\Request;

class SpouseestateController extends Controller
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
        $user_id = Auth::user()->id;
        $count = \App\SpouseEstate::where('user_id', $user_id)->get()->count();

        if ($count > 0) {
            $spouse_estate = \App\SpouseEstate::where('user_id', $user_id)
                                    ->with('Address')
                                    ->get();
            
            return response()->json(['status' => 200, 'data' => $spouse_estate], 200);
        } else {
            return response()->json(['status' => 200, 'data' => [[]]], 200);
        }
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

        $user_id        = Auth::user()->id;
        $legal_name     = $inputs['legal_name'] ? $inputs['legal_name'] : "";
        $relationship   = $inputs['relationship'] ? $inputs['relationship'] : "";
        $company        = $inputs['company'] ? $inputs['company'] : "";
        $phone          = $inputs['phone'] ? $inputs['phone'] : "";
        $email          = $inputs['email'] ? $inputs['email'] : "";
        $website        = $inputs['website'] ? $inputs['website'] : "";
        $street_address1   = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $street_address2   = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $city              = $inputs['city'] ? $inputs['city'] : "";
        $state             = $inputs['state'] ? $inputs['state'] : "";
        $zipcode           = $inputs['zipcode'] ? $inputs['zipcode'] : "";

        try {
            $objSpouseEstate = new \App\SpouseEstate();

            $objSpouseEstate->user_id         = $user_id;
            $objSpouseEstate->legal_name      = $legal_name;
            $objSpouseEstate->relationship    = $relationship;
            $objSpouseEstate->company         = $company;
            $objSpouseEstate->phone           = $phone;
            $objSpouseEstate->email           = $email;
            $objSpouseEstate->website         = $website;
            $objSpouseEstate->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            $objAddress = new \App\SpouseestateAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->spouse_estate_id   = $objSpouseEstate->id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Spouse Estate information has been saved successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Error'], 500);
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
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = \App\SpouseEstate::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $spouseestate_info = \App\SpouseEstate::where('id', $id)
                        ->with('Address')
                        ->get();
            
            return response()->json(['status' => 200, 'data' => $spouseestate_info]);
        } else {
            return response()->json(['status' => 200, 'data' => [[]]]);
        }
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

        $user_id        = Auth::user()->id;
        $legal_name     = $inputs['legal_name'] ? $inputs['legal_name'] : "";
        $relationship   = $inputs['relationship'] ? $inputs['relationship'] : "";
        $company        = $inputs['company'] ? $inputs['company'] : "";
        $phone          = $inputs['phone'] ? $inputs['phone'] : "";
        $email          = $inputs['email'] ? $inputs['email'] : "";
        $website        = $inputs['website'] ? $inputs['website'] : "";
        $street_address1   = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $street_address2   = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $city              = $inputs['city'] ? $inputs['city'] : "";
        $state             = $inputs['state'] ? $inputs['state'] : "";
        $zipcode           = $inputs['zipcode'] ? $inputs['zipcode'] : "";

        try {
            $objSpouseEstate = \App\SpouseEstate::find($id);

            $objSpouseEstate->user_id         = $user_id;
            $objSpouseEstate->legal_name      = $legal_name;
            $objSpouseEstate->relationship    = $relationship;
            $objSpouseEstate->company         = $company;
            $objSpouseEstate->phone           = $phone;
            $objSpouseEstate->email           = $email;
            $objSpouseEstate->website         = $website;
            $objSpouseEstate->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //remove address
            \App\SpouseestateAddress::where('spouse_estate_id', $id)->delete();

            $objAddress = new \App\SpouseestateAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Spouse Estate information has been updated successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => 'Error'], 500);
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
        $user_id = Auth::user()->id;

        try {
                
            //remove family member phone
            \App\SpouseestateAddress::where('spouse_estate_id', $id)->delete();

            //remove 
            \App\SpouseEstate::where('id', $id)->delete();

            //get count of remaining members
            $count = \App\SpouseEstate::where('user_id', $user_id)->get()->count();

            if ($count == 0) {
                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                    ->where('user_id', $user_id)
                    ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            }

            return response()->json(['status' => 200, 'msg' => 'Spouse Estate information has removed successfully', 'estate_count' => $count], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error', 'estate_count' => 0], 500);
        }
    }

    public function updatespouseestatestatus(Request $request) {
        $inputs             = $request->all();
        $user_id            = Auth::user()->id;
        $has_spouseestate   = $inputs['has_spouseestate'];

        try {
            $objSpouseestateStatus = \App\SpouseestateStatus::where('user_id', $user_id)->get();

            if ($objSpouseestateStatus->count()) {
                \App\SpouseestateStatus::where('user_id', $user_id)
                                    ->update(['has_spouseestate' => $has_spouseestate]);
            } else {
                \App\SpouseestateStatus::create(['user_id' => $user_id, 'has_spouseestate' => $has_spouseestate]);
            }

            if ($objSpouseestateStatus == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                                                    ->where('user_id', $user_id)
                                                    ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Spouse estate status has been updated successfully'], 200);

        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function getspouseestatestatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objSpouseEstateStatus    = \App\SpouseestateStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objSpouseEstateStatus], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 200, 'data' => [[]]], 200);
        }
    }

    public function updatestatus(Request $request) {
        $inputs = $request->all();
        $user_id    = Auth::user()->id;
        $is_completed = @$inputs['chk_complete'] ? '1' : '0';

        //insert record in user personal details completion
        $arrData = ['is_completed' => $is_completed];

        \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                                             ->where('user_id', $user_id)
                                             ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Spouse Estate information has completed successfully'], 200);
    }
}
