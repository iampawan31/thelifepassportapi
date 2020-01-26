<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use Illuminate\Http\Request;

class HomeassistantController extends Controller
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
        $count = \App\HomeAssistant::where('user_id', $user_id)->get()->count();

        if ($count > 0) {
            $homeassistant_info = \App\HomeAssistant::where('user_id', $user_id)
                                    ->with('Address')
                                    ->get();
            
            return response()->json(['status' => 200, 'data' => $homeassistant_info], 200);
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

        $user_id                = Auth::user()->id;
        $person_name            = $inputs['person_name'] ? $inputs['person_name'] : "";
        $provider_name          = $inputs['provider_name'] ? $inputs['provider_name'] : "";
        $assistant_frequency    = $inputs['assistant_frequency'] ? $inputs['assistant_frequency'] : "";
        $care_date              = $inputs['care_date'] ? date('Y-m-d', strtotime($inputs['assistant_frequency'])) : "";
        $care_time              = $inputs['care_time'] ? date('Y-m-d', strtotime($inputs['care_time'])) : "";
        $street_address1        = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $street_address2        = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $city                   = $inputs['city'] ? $inputs['city'] : "";
        $state                  = $inputs['state'] ? $inputs['state'] : "";
        $zipcode                = $inputs['zipcode'] ? $inputs['zipcode'] : "";

        try {
            $objHomeAssistant = new \App\HomeAssistant();

            $objHomeAssistant->user_id                = $user_id;
            $objHomeAssistant->person_name            = $person_name;
            $objHomeAssistant->provider_name          = $provider_name;
            $objHomeAssistant->assistant_frequency    = $assistant_frequency;
            $objHomeAssistant->care_date              = $care_date;
            $objHomeAssistant->person_name            = $care_time;
            $objHomeAssistant->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 6)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            $objAddress = new \App\HomeAssistantAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->assistant_id       = $objHomeAssistant->id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Home Assistant has been saved successfully'], 200);

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
        $count = \App\HomeAssistant::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $homeassistant_info = \App\HomeAssistant::where('id', $id)
                        ->with('Address')
                        ->get();
            
            return response()->json(['status' => 200, 'data' => $homeassistant_info]);
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

        $user_id                = Auth::user()->id;
        $person_name            = $inputs['person_name'] ? $inputs['person_name'] : "";
        $provider_name          = $inputs['provider_name'] ? $inputs['provider_name'] : "";
        $assistant_frequency    = $inputs['assistant_frequency'] ? $inputs['assistant_frequency'] : "";
        $care_date              = $inputs['care_date'] ? date('Y-m-d', strtotime($inputs['assistant_frequency'])) : "";
        $care_time              = $inputs['care_time'] ? date('Y-m-d', strtotime($inputs['care_time'])) : "";
        $street_address1        = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $street_address2        = $inputs['street_address_1'] ? $inputs['street_address_1'] : "";
        $city                   = $inputs['city'] ? $inputs['city'] : "";
        $state                  = $inputs['state'] ? $inputs['state'] : "";
        $zipcode                = $inputs['zipcode'] ? $inputs['zipcode'] : "";

        try {
            //update home assistant record
            $objHomeAssistant = \App\HomeAssistant::find($id);

            $objHomeAssistant->user_id                = $user_id;
            $objHomeAssistant->person_name            = $person_name;
            $objHomeAssistant->provider_name          = $provider_name;
            $objHomeAssistant->assistant_frequency    = $assistant_frequency;
            $objHomeAssistant->care_date              = $care_date;
            $objHomeAssistant->person_name            = $care_time;
            $objHomeAssistant->save();

            //update record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 6)
                                                ->where('user_id', $user_id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            
            //remove address
            \App\HomeAssistantAddress::where('assistant_id', $id)->delete();

            //add home assistant address
            $objAddress = new \App\HomeAssistantAddress();

            $objAddress->user_id            = $user_id;
            $objAddress->assistant_id       = $objHomeAssistant->id;
            $objAddress->street_address1    = $street_address1;
            $objAddress->street_address2    = $street_address2;
            $objAddress->city               = $city;
            $objAddress->state              = $state;
            $objAddress->zipcode            = $zipcode;

            $objAddress->save();

            return response()->json(['status' => 200, 'message' => 'Home Assistant has been updated successfully'], 200);

        } catch(Exception $e) {
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
            \App\HomeAssistantAddress::where('assistant_id', $id)->delete();

            //remove 
            \App\HomeAssistant::where('id', $id)->delete();

            //get count of remaining members
            $count = \App\HomeAssistant::where('user_id', $user_id)->get()->count();

            if ($count == 0) {
                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 6)
                    ->where('user_id', $user_id)
                    ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            }

            return response()->json(['status' => 200, 'msg' => 'Family member information has removed successfully', 'assistant_count' => $count], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error', 'assistant_count' => 0], 500);
        }
    }

    public function updatehomeassistantstatus(Request $request) {
        $inputs             = $request->all();
        $user_id            = Auth::user()->id;
        $has_homeassistant  = $inputs['has_homeassistant'];

        try {
            $objHomeAssistantStatus = \App\HomeassistantStatus::where('user_id', $user_id)->get();

            if ($objHomeAssistantStatus->count()) {
                \App\HomeassistantStatus::where('user_id', $user_id)
                                    ->update(['has_homeassistant' => $has_homeassistant]);
            } else {
                \App\HomeassistantStatus::create(['user_id' => $user_id, 'has_friends' => $has_friends]);
            }

            if ($objHomeAssistantStatus == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 6)
                                                    ->where('user_id', $user_id)
                                                    ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Home Assistant status has been updated successfully'], 200);

        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function gethomeassistantstatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objHomeAssistantStatus    = \App\HomeassistantStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objHomeAssistantStatus], 200);
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

        \App\UsersPersonalDetailsCompletion::where('step_id', 6)
                                             ->where('user_id', $user_id)
                                             ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Home assistant information has completed successfully']);
    }
}
