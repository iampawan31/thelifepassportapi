<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;

class FriendsController extends Controller
{
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
        $legal_name = $inputs['legal_name'];
        $address    = $inputs['address'];
        $email      = $inputs['email'];

        try {
            //insert personal information
            $objFriends = new \App\Friends();
            
            $objFriends->user_id    = Auth::user()->id;
            $objFriends->legal_name = $legal_name ? $legal_name : "";
            $objFriends->address    = $address ? $address : "";
            $objFriends->email      = $email ? $email : "";
            $objFriends->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 5)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //phone info
            $arrPhone = [];
            if (isset($inputs['phone'])) {
                foreach($inputs['phone'] as $phone) {
                    if ($phone) {
                        $arrPhone[] = ['user_id' => Auth::user()->id, 'friend_id' => $objFriends->id, 'phone' => $phone];
                    }
                }
            }
            //insert phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\FriendsPhone::create($phones);
                } 
            }

            //increase family members count
            $objFamilyStatus    = \App\FriendsStatus::where('user_id', Auth::user()->id)
                ->update(['count'=> \DB::raw('count+1')]);

            return response()->json(['status' => 200, 'message' => 'Friends information has been saved successfully']);

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
        $count = \App\Friends::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $friends_info = \App\Friends::where('id', $id)
                        ->with('FriendsPhone')
                        ->with('UsersPersonalDetailsCompletion')
                        ->get();
            
            return response()->json(['status' => 200, 'data' => $friends_info]);
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
        $address            = $inputs['address'];
        $email              = $inputs['email'];
        
        try {//
            //get spouse information
            $objFriends = \App\Friends::find($id);
            
            $objFriends->legal_name = $legal_name ? $legal_name : "";
            $objFriends->address    = $address ? $address : "";
            $objFriends->email      = $email ?  $email: "";
            $objFriends->save();
            
            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 5)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //phone info
            $arrPhone = [];
            if (isset($inputs['phone'])) {
                foreach($inputs['phone'] as $phone) {
                    if ($phone) {
                        $arrPhone[] = ['user_id' => Auth::user()->id, 'friend_id' => $id, 'phone' => $phone];
                    }
                }
            }

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\FriendsPhone::where('friend_id', $id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\FriendsPhone::create($phones);
                } 
            }
            
            return response()->json(['status' => 200, 'message' => 'Friends information has been saved successfully']);
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
                \App\FriendsPhone::where('friend_id', $id)->delete();

                //remove 
                \App\Friends::where('id', $id)->delete();

                //get count of remaining members
                $count = \App\Friends::where('user_id', Auth::user()->id)->get()->count();

                //check members count
                \App\FriendsStatus::where('user_id', Auth::user()->id)
                    ->update(['count'=> \DB::raw('count-1')]);

                if ($count == 0) {
                    //check members count
                    \App\FriendsStatus::where('user_id', Auth::user()->id)
                        ->update(['has_friends' => '0', 'count' => '0']);

                    //update step table
                    \App\UsersPersonalDetailsCompletion::where('step_id', 5)
                        ->where('user_id', Auth::user()->id)
                        ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
                }
            //});

            return response()->json(['status' => 200, 'msg' => 'Family member information has removed successfully', 'family_count' => $count], 200);
        } catch(Exception $e) {
            dd($e);
            return response()->json(['status' => 500, 'msg' => 'Error', 'family_count' => 0], 500);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getfriendsinfo() {
        //\DB::enableQueryLog();
        $user_id = Auth::user()->id;
        $count = \App\Friends::where('user_id', $user_id)->get()->count();
        
        if ($count > 0) {
            $friends_info = \App\Friends::where('user_id', $user_id)
                ->with('FriendsPhone')
                ->with('UsersPersonalDetailsCompletion')
                ->get();
            //dd(\DB::getQueryLog());
            return response()->json(['status' => 200, 'data' => $friends_info]);
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
    public function updatefriendsstatus(Request $request) {
        $inputs = $request->all();
        $user_id    = Auth::user()->id;
        $has_friends = $inputs['has_friends'];

        try {
            //\DB::enableQueryLog();
            //check for record
            $objFriendsStatus = \App\FriendsStatus::where('user_id', $user_id)->get();
            
            if ($objFriendsStatus->count()) {
                \App\FamilyStatus::where('user_id', $user_id)
                                    ->update(['has_friends' => $has_friends]);
            } else {
                \App\FamilyStatus::create(['user_id' => $user_id, 'has_friends' => $has_friends]);
            }
             //dd(\DB::getQueryLog());
            //insert record in user personal details completion
            if ($has_friends == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 5)
                                                 ->where('user_id', $user_id)
                                                 ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Friends status has been updated successfully']);
        } catch (Exception $e) {dd($e);
            return response()->json(['status' => 503, 'msg' => 'Error']);
        }
    }

    public function getfriendsstatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objFriendsStatus    = \App\FriendsStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objFriendsStatus]);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'data' => [[]]]);
        }
    }

    public function updatestatus(Request $request) {
        $inputs = $request->all();
        $user_id    = Auth::user()->id;
        $is_completed = @$inputs['chk_complete'] ? '1' : '0';

        //insert record in user personal details completion
        $arrData = ['is_completed' => $is_completed];

        \App\UsersPersonalDetailsCompletion::where('step_id', 5)
                                             ->where('user_id', $user_id)
                                             ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Friends information has completed successfully']);
    }
}
