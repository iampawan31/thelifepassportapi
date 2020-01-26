<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use Illuminate\Http\Request;

class PersonalestateController extends Controller
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
        $count = \App\PersonalEstate::where('user_id', $user_id)->get()->count();

        if ($count > 0) {
            $personal_estate = \App\PersonalEstate::where('user_id', $user_id)
                                    ->with('Address')
                                    ->get();
            
            return response()->json(['status' => 200, 'data' => $personal_estate], 200);
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
            $objPersonalEstate = new \App\PersonalEstate();

            $objPersonalEstate->user_id         = $user_id;
            $objPersonalEstate->legal_name      = $legal_name;
            $objPersonalEstate->relationship    = $relationship;
            $objPersonalEstate->company         = $company;
            $objPersonalEstate->phone           = $phone;
            $objPersonalEstate->email           = $email;
            $objPersonalEstate->website         = $website;
            $objPersonalEstate->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            $objAddress = new \App\PersonalestateAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->estate_id          = $objPersonalEstate->id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Personal Estate information has been saved successfully'], 200);

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
        $count = \App\PersonalEstate::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $personalestate_info = \App\PersonalEstate::where('id', $id)
                        ->with('Address')
                        ->get();
            
            return response()->json(['status' => 200, 'data' => $personalestate_info]);
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
            $objPersonalEstate = \App\PersonalEstate::find($id);

            $objPersonalEstate->user_id         = $user_id;
            $objPersonalEstate->legal_name      = $legal_name;
            $objPersonalEstate->relationship    = $relationship;
            $objPersonalEstate->company         = $company;
            $objPersonalEstate->phone           = $phone;
            $objPersonalEstate->email           = $email;
            $objPersonalEstate->website         = $website;
            $objPersonalEstate->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //remove address
            \App\PersonalestateAddress::where('estate_id', $id)->delete();

            $objAddress = new \App\PersonalestateAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Personal Estate information has been updated successfully'], 200);

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
            \App\PersonalestateAddress::where('estate_id', $id)->delete();

            //remove 
            \App\PersonalEstate::where('id', $id)->delete();

            //get count of remaining members
            $count = \App\PersonalEstate::where('user_id', $user_id)->get()->count();

            if ($count == 0) {
                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                    ->where('user_id', $user_id)
                    ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            }

            return response()->json(['status' => 200, 'msg' => 'Personal Estate information has removed successfully', 'estate_count' => $count], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error', 'estate_count' => 0], 500);
        }
    }

    public function updatepersonalestatestatus(Request $request) {
        $inputs             = $request->all();
        $user_id            = Auth::user()->id;
        $has_personalestate = $inputs['has_personalestate'];

        try {
            $objPersonalestateStatus = \App\PersonalestateStatus::where('user_id', $user_id)->get();

            if ($objPersonalestateStatus->count()) {
                \App\PersonalestateStatus::where('user_id', $user_id)
                                    ->update(['has_personalestate' => $has_personalestate]);
            } else {
                \App\PersonalestateStatus::create(['user_id' => $user_id, 'has_personalestate' => $has_personalestate]);
            }

            if ($objPersonalestateStatus == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                                                    ->where('user_id', $user_id)
                                                    ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Personal estate status has been updated successfully'], 200);

        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function getpersonalestatestatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objPersonalEstateStatus    = \App\PersonalestateStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objPersonalEstateStatus], 200);
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

        \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                                             ->where('user_id', $user_id)
                                             ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Personal Estate information has completed successfully'], 200);
    }
}
