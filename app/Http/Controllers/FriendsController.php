<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Exception;
use App\Friends;
use Session, Auth;
use App\PersonalInfo;
use App\FriendsPhone;
use App\FriendsStatus;
use App\FriendsAddress;
use Illuminate\Http\Request;
use App\UsersPersonalDetailsCompletion;

class FriendsController extends Controller
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
        $legal_name = $inputs['legal_name'];
        $email      = $inputs['email'];

        try {
            $user = User::find(auth()->id());

            DB::beginTransaction();

            //insert personal information
            $objFriends = new Friends;
            
            $objFriends->user_id    = $user->id;
            $objFriends->legal_name = $legal_name ? $legal_name : "";
            $objFriends->email      = $email ? $email : "";
            $objFriends->save();

            // Save friends address
            $address = json_decode(request('friends_address'));

            if (!empty($address)) {
                $friendsAddress = new FriendsAddress;

                $friendsAddress->user_id         = $user->id;
                $friendsAddress->friend_id       = $objFriends->id;
                $friendsAddress->street_address1 = $address->street_address1 ?: "";
                $friendsAddress->street_address2 = $address->street_address2 ?: "";
                $friendsAddress->city            = $address->city ?: "";
                $friendsAddress->state           = $address->state ?: "";
                $friendsAddress->zipcode         = $address->zipcode ?: "";

                $friendsAddress->save();
            }

            //Saving Friends phone numbers
            $phoneNumbers = json_decode(request('friends_phones'));
            
            if (!empty($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        FriendsPhone::create(['user_id' => $user->id, 'friend_id' => $objFriends->id, 'phone' => $phone->phone]);
                    }
                }
            }

            //insert record in user personal details completion
            UsersPersonalDetailsCompletion::where('step_id', 5)
                                                ->where('user_id', $user->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            //increase family members count
            $objFamilyStatus    = FriendsStatus::where('user_id', $user->id)
                ->update(['count'=> DB::raw('count+1')]);

            DB::commit();

            return response()->json(['status' => 200, 'message' => 'Friends information has been saved successfully']);

        } catch (Exception $e) {dd($e);
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
        $count = Friends::where('id', $id)->get()->count();
        
        if ($count > 0) {
            $friends_info = Friends::where('id', $id)
                        ->with('address')
                        ->with('phone')
                        ->with('step')
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
        $email              = $inputs['email'];
        
        try {
            $user = User::find(auth()->id());

            DB::beginTransaction();

            //get spouse information
            $objFriends = Friends::find($id);
            
            $objFriends->legal_name = $legal_name ? $legal_name : "";
            $objFriends->email      = $email ?  $email: "";
            $objFriends->save();
            
            // Save user's personal address
            $address = json_decode(request('friends_address'));

            if (!empty($address)) {
                $prevSpouseAddress = FriendsAddress::updateOrCreate([
                    'user_id' => $user->id, 'friend_id' => $id
                ],[
                    'street_address1' => $address->street_address1 ?: "",
                    'street_address2' => $address->street_address2 ?: "",
                    'city'            => $address->city ?: "",
                    'state'           => $address->state ?: "",
                    'zipcode'         => $address->zipcode ?: ""
                ]);
            }

            //Saving Friends phone numbers
            $phoneNumbers = json_decode(request('friends_phones'));
                
            if (!empty($phoneNumbers)) {
                FriendsPhone::where('user_id', $user->id)->delete();
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        FriendsPhone::create(['user_id' => $user->id, 'friend_id' => $id, 'phone' => $phone->phone]);
                    }
                }
            }

            //insert record in user personal details completion
            UsersPersonalDetailsCompletion::where('step_id', 5)
                                                ->where('user_id', $user->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1']);

            // //phone info
            // $arrPhone = [];
            // if (isset($inputs['phone'])) {
            //     foreach($inputs['phone'] as $phone) {
            //         if ($phone) {
            //             $arrPhone[] = ['user_id' => Auth::user()->id, 'friend_id' => $id, 'phone' => $phone];
            //         }
            //     }
            // }

            // //insert phone information
            // if (!empty($arrPhone)) {
            //     //remove all phone details
            //     \App\FriendsPhone::where('friend_id', $id)->delete();
            //     foreach($arrPhone as $phones){
            //         $objPhone = \App\FriendsPhone::create($phones);
            //     } 
            // }
            
            DB::commit();

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
                FriendsPhone::where('friend_id', $id)->delete();

                //remove famimly address
                FriendsAddress::where('friend_id', $id)->delete();

                //remove 
                Friends::where('id', $id)->delete();

                //get count of remaining members
                $count = Friends::where('user_id', auth()->id())->get()->count();

                //check members count
                FriendsStatus::where('user_id', auth()->id())
                    ->update(['count'=> DB::raw('count-1')]);

                if ($count == 0) {
                    //check members count
                    FriendsStatus::where('user_id', Auth::user()->id)
                        ->update(['has_friends' => '0', 'count' => '0']);

                    //update step table
                    UsersPersonalDetailsCompletion::where('step_id', 5)
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
        $count = Friends::where('user_id', $user_id)->get()->count();
        
        if ($count > 0) {
            $friends_info = Friends::where('user_id', $user_id)
                ->with('address')
                ->with('phone')
                ->with('step')
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
            $objFriendsStatus = FriendsStatus::where('user_id', $user_id)->get();
            
            if ($objFriendsStatus->count()) {
                FriendsStatus::where('user_id', $user_id)
                                    ->update(['has_friends' => $has_friends]);
            } else {
                FriendsStatus::create(['user_id' => $user_id, 'has_friends' => $has_friends]);
            }
             //dd(\DB::getQueryLog());
            //insert record in user personal details completion
            if ($has_friends == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            }

            UsersPersonalDetailsCompletion::where('step_id', 5)
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
            $objFriendsStatus    = FriendsStatus::find($user_id);
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

        UsersPersonalDetailsCompletion::where('step_id', 5)
                                             ->where('user_id', $user_id)
                                             ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Friends information has completed successfully']);
    }
}
