<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;

class FamilyController extends Controller
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
        
        //personal information
        $legal_name         = $inputs['legal_name'];
        $relationship_id    = $inputs['relationship'];
        $relatiionship_other= @$inputs['relatiionship_other'];
        $address            = $inputs['address'];
        $email              = $inputs['email'];
        $dob                = $inputs['dob'];

        try {
            //insert personal information
            $objMemberInfo = new \App\FamilyMembers();
            
            $objMemberInfo->user_id               = Auth::user()->id;
            $objMemberInfo->legal_name            = $legal_name ? $legal_name : "";
            $objMemberInfo->relationship_id       = $relationship_id ? $relationship_id : 0;
            $objMemberInfo->relatiionship_other   = $relatiionship_other ? $relatiionship_other : "";
            $objMemberInfo->address               = $address ? $address : "";
            $objMemberInfo->email                 = $email ? $email : "";
            $objMemberInfo->dob                   = $dob ? date('Y-m-d', strtotime($dob)) : null;
            $objMemberInfo->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 4)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //phone info
            $arrPhone = [];
            if (isset($inputs['phone'])) {
                foreach($inputs['phone'] as $phone) {
                    if ($phone) {
                        $arrPhone[] = ['user_id' => Auth::user()->id, 'family_member_id' => $objMemberInfo->user_id, 'phone' => $phone];
                    }
                }
            }
            //insert phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\FamilyPhone::create($phones);
                } 
            }

            //increase family members count
            $objFamilyStatus    = \App\FamilyStatus::where('user_id', $user_id)->get();
            $objFamilyStatus->count = $objFamilyStatus->count + 1;
            $objFamilyStatus->save();

            return response()->json(['status' => 200, 'message' => 'Family members information has been saved successfully']);

        } catch (Exception $e) {
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
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = \App\FamilyMembers::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $member_info = \App\FamilyMembers::where('id', $id)
                        ->with('FamilyPhone')
                        ->with('FamilyPhone')
                        ->with('UsersPersonalDetailsCompletion')
                        ->get();
            
            return response()->json(['status' => 200, 'data' => $member_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
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
        
        //personal information
        $legal_name         = $inputs['legal_name'];
        $relationship_id    = $inputs['relationship'];
        $relatiionship_other= $inputs['relatiionship_other'];
        $address            = $inputs['address'];
        $email              = $inputs['email'];
        $dob                = $inputs['dob'];
        
        try {//
            //get spouse information
            $objMemberInfo = \App\FamilyMembers::find($id);
            
            //$objPersonalInfo->user_id       = Auth::user()->id;
            $objMemberInfo->legal_name          = $legal_name ? $legal_name : "";
            $objMemberInfo->relationship_id     = $relationship_id ? $relationship_id : 0;
            $objMemberInfo->address             = $address ? $address : "";
            $objMemberInfo->email               = $email ?  $email: "";
            $objMemberInfo->dob                 = $dob ? date('Y-m-d', strtotime($dob)) : null;
            $objMemberInfo->relatiionship_other = $relatiionship_other ? $relatiionship_other : "";
            $objMemberInfo->save();
            
            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 4)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //phone info
            $arrPhone = [];
            if (isset($inputs['phone'])) {
                foreach($inputs['phone'] as $phone) {
                    if ($phone) {
                        $arrPhone[] = ['user_id' => Auth::user()->id, 'family_member_id' => $id, 'phone' => $phone];
                    }
                }
            }

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\FamilyPhone::where('family_member_id', $id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\FamilyPhone::create($phones);
                } 
            }
            
            return response()->json(['status' => 200, 'message' => 'Personal information has been saved successfully']);
        } catch (Exception $e) {
            dd($e);
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
        try {
            //\DB::transaction(function ($id) {
                
                //remove family member phone
                \App\FamilyPhone::where('family_member_id', $id)->delete();

                //remove 
                \App\FamilyMembers::where('id', $id)->delete();

                //get count of remaining members
                $count = \App\FamilyMembers::where('user_id', Auth::user()->id)->get()->count();

                if ($count == 0) {
                    //check members count
                    $count = \App\FamilyStatus::where('user_id', Auth::user()->id)->delete();

                    //update step table
                    \App\UsersPersonalDetailsCompletion::where('step_id', 4)
                        ->where('user_id', Auth::user()->id)
                        ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
                }
            //});

            return response()->json(['status' => 200, 'msg' => 'Family member information has removed successfully'], 200);
        } catch(Exception $e) {
            dd($e);
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getfamilymembersinfo() {
        //\DB::enableQueryLog();
        $user_id = Auth::user()->id;
        $count = \App\FamilyMembers::where('user_id', $user_id)->get()->count();
        
        if ($count > 0) {
            $spouse_info = \App\FamilyMembers::where('user_id', $user_id)
                ->with('FamilyPhone')
                ->with('FamilyRelation')
                ->with('UsersPersonalDetailsCompletion')
                ->get();
            //dd(\DB::getQueryLog());
            return response()->json(['status' => 200, 'data' => $spouse_info]);
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
    public function updatefamilystatus(Request $request) {
        $inputs = $request->all();
        $user_id    = Auth::user()->id;
        $has_family_member = $inputs['has_family_member'];

        try {
            //check for record
            $objMarriageStatus = \App\FamilyStatus::where('user_id', $user_id)->get();
            
            if ($objMarriageStatus->count()) {
                \App\FamilyStatus::where('user_id', $user_id)
                                    ->update(['has_family_member' => $has_family_member]);
                // $objMarriageStatus->is_married = $is_married;
                // $objMarriageStatus->save();
            } else {
                \App\FamilyStatus::create(['user_id' => $user_id, 'has_family_member' => $has_family_member]);
            }
             
            //insert record in user personal details completion
            if ($has_family_member == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 4)
                                                 ->where('user_id', $user_id)
                                                 ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Marriage status has been updated successfully']);
        } catch (Exception $e) {dd($e);
            return response()->json(['status' => 503, 'msg' => 'Error']);
        }
    }

    public function getfamilymembersstatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objFamilyStatus    = \App\FamilyStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objFamilyStatus]);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'data' => [[]]]);
        }
    }

    public function familyrelations() {

        $arrFamilyRelation = \App\FamilyRelation::select('id', 'title')->where('status', '1')->get();
        
        $data = [];
        if ($arrFamilyRelation->count()) {
            foreach( $arrFamilyRelation as $relation ) {
                $data[] = ['id' => $relation->id, 'text' => $relation->title];
            }
        }
        return response()->json(['relation' => $data]);

    }
}
