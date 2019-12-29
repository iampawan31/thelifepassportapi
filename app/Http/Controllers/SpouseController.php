<?php

namespace App\Http\Controllers;

use App\User;
use Exception;
use Session, Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;

class SpouseController extends Controller
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
        $nick_name          = $inputs['nickname'];
        $home_address       = $inputs['home_address'];
        $dob                = $inputs['dob'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];
        $marriage_date      = $inputs['marriage_date'];
        $marriage_location  = $inputs['marriage_location'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => Auth::user()->id, 'phone' => $phone];
                }
            }
        }

        //email info
        $arrEmail = [];
        if (isset($inputs['email'])) {
            foreach($inputs['email'] as $key => $value) {
                if ($value) {
                    $arrEmail[] = ['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]];
                } 
            }
        }

        //social media info
        $arrSocial = [];
        if (isset($inputs['social_media_type'])) {
            foreach($inputs['social_media_type'] as $key => $value) {
                if ($value) {
                    $arrSocial[] = ['user_id' => Auth::user()->id, 'social_id' => $value, 'username' => $inputs['social_username'][$key], 'password' => $inputs['social_password'][$key]];
                }
                
            }
        }

        //employer info
        $arrEmployer = [];
        if (isset($inputs['employer_name'])) {
            foreach($inputs['employer_name'] as $key => $value) {
                if (!empty($value)) {
                    $arrEmployer[] = [
                        'user_id'                   => Auth::user()->id,
                        'employer_name'             => $value, 
                        'employer_phone'            => $inputs['employer_phone'][$key], 
                        'employer_address'          => $inputs['employer_address'][$key],
                        'computer_username'         => $inputs['company_computer_username'][$key],
                        'computer_password'         => $inputs['company_computer_password'][$key],
                        'benefits_used'             => $inputs['employee_benifits'][$key]
                    ];
                }
            }
        }

        $arrSpouseInfo = [
            'user_id'           => Auth::user()->id,
            'legal_name'        => $legal_name ? $legal_name : "",
            'nickname'          => $nick_name ? $nick_name : "",
            'home_address'      => $home_address ? $home_address : "",
            'dob'               => $dob ? date('Y-m-d', strtotime($dob)) : "",
            'country_id'        => $country_id ? $country_id : "",
            'passport_number'   => $passport_number ? $passport_number : "",
            'father_name'       => $father_name ? $father_name : "",
            'father_birth_place'    => $father_birth_place ? $father_birth_place : "",
            'mother_name'           => $mother_name ? $mother_name : "",
            'mother_birth_place'    => $mother_birth_place ? $mother_birth_place : "",
            'marriage_date'        => $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : "",
            'marriage_location'    => $marriage_location ? $marriage_location: ""
        ];
        
        try {
            //insert personal information
            $objSpouseInfo = \App\SpouseInfo::create($arrSpouseInfo);
            
            // //insert record in user personal details completion
            // \App\UsersPersonalDetailsCompletion::where('step_id', 2)
            //                                     ->where('user_id', Auth::user()->id)
            //                                     ->update(['is_filled' => '1']);

            //insert phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\SpousePhone::create($phones);
                } 
            }

            //insert email information
            if (!empty($arrEmail)) {
                foreach($arrEmail as $emails) {
                    \App\SpouseEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                foreach($arrSocial as $socials) {
                    \App\SpouseSocialMedia::create($socials);
                }
            }
            
            if(!empty($arrEmployer)) {
                foreach($arrEmployer as $employers) {
                    \App\SpouseEmployer::create($employers);
                }
            }

            return response()->json(['status' => 200, 'message' => 'Spouse information has been saved successfully']);

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
        $count = \App\SpouseInfo::where('user_id', $id)->get()->count();
        if ($count > 0) {
            $spouse_info = \App\PersonalInfo::find($id)
                ->with('SpousePhone')
                ->with('SpouseEmail')
                ->with('SpouseSocailMedia')
                ->with('SpouseEmployer')
                ->get();
            
            return response()->json(['status' => 200, 'data' => $spouse_info]);
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
        $legal_name         = $inputs['legal_name'];
        $nick_name          = $inputs['nickname'];
        $home_address       = $inputs['home_address'];
        $dob                = $inputs['dob'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];
        $marriage_date      = $inputs['marriage_date'];
        $marriage_location  = $inputs['marriage_location'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => Auth::user()->id, 'phone' => $phone];
                }
            }
        }

        //email info
        $arrEmail = [];
        if (isset($inputs['email'])) {
            foreach($inputs['email'] as $key => $value) {
                if ($value) {
                    $arrEmail[] = ['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]];
                } 
            }
        }

        //social media info
        $arrSocial = [];
        if (isset($inputs['social_media_type'])) {
            foreach($inputs['social_media_type'] as $key => $value) {
                if ($value) {
                    $arrSocial[] = ['user_id' => Auth::user()->id, 'social_id' => $value, 'username' => $inputs['social_username'][$key], 'password' => $inputs['social_password'][$key]];
                }
                
            }
        }

        //employer info
        $arrEmployer = [];
        if (isset($inputs['employer_name'])) {
            foreach($inputs['employer_name'] as $key => $value) {
                if (!empty($value)) {
                    $arrEmployer[] = [
                        'user_id'                   => Auth::user()->id,
                        'employer_name'             => $value, 
                        'employer_phone'            => $inputs['employer_phone'][$key], 
                        'employer_address'          => $inputs['employer_address'][$key],
                        'computer_username'         => $inputs['company_computer_username'][$key],
                        'computer_password'         => $inputs['company_computer_password'][$key],
                        'benefits_used'             => $inputs['employee_benifits'][$key]
                    ];
                }
            }
        }
        
        try {
            //get spouse information
            $objSpouseInfo = \App\SpouseInfo::find($id);

            //$objPersonalInfo->user_id       = Auth::user()->id;
            $objSpouseInfo->legal_name    = $legal_name ? $legal_name : "";
            $objSpouseInfo->nickname      = $nick_name ? $nick_name : "";
            $objSpouseInfo->home_address  = $home_address ? $home_address : "";
            $objSpouseInfo->dob           = $dob ? date('Y-m-d', strtotime($dob)) : "";
            $objSpouseInfo->country_id    = $country_id ? $country_id : "";
            $objSpouseInfo->passport_number = $passport_number ? $passport_number : "";
            $objSpouseInfo->father_name     = $father_name ? $father_name : "";
            $objSpouseInfo->father_birth_place  = $father_birth_place ? $father_birth_place : "";
            $objSpouseInfo->mother_name         = $mother_name ? $mother_name : "";
            $objSpouseInfo->mother_birth_place  = $mother_birth_place ? $mother_birth_place : "";
            $objSpouseInfo->marriage_date       = $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : "";
            $objSpouseInfo->marriage_location   = $marriage_location ? $marriage_location : "";
            $objSpouseInfo->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 2)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_filled' => '1']);

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\SpousePhone::where('user_id', Auth::user()->id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\SpousePhone::create($phones);
                } 
            }

            //insert email information
            if (!empty($arrEmail)) {
                //remove email details
                \App\SpouseEmail::where('user_id', Auth::user()->id)->delete();

                foreach($arrEmail as $emails) {
                    \App\SpouseEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                //remove social media info
                \App\SpouseSocialMedia::where('user_id', Auth::user()->id)->delete();

                foreach($arrSocial as $socials) {
                    \App\SpouseSocialMedia::create($socials);
                }
            }
            
            if(!empty($arrEmployer)) {
                //remove employer details
                \App\SpouseEmployer::where('user_id', Auth::user()->id)->delete();

                foreach($arrEmployer as $employers) {
                    \App\SpouseEmployer::create($employers);
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
        //
    }
    
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function getspouseinfo() {
        $user_id = Auth::user()->id;
        $count = \App\SpouseInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $spouse_info = \App\SpouseInfo::find($user_id)
                ->with('SpousePhone')
                ->with('SpouseEmail')
                ->with('SpouseSocailMedia')
                ->with('SpouseEmployer')
                ->get();
            
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
    public function updatemarriagestatus(Request $request) {
        $inputs = $request->all();
        
        $user_id    = Auth::user()->id;
        
        $is_married = $inputs['is_married'];

        try {
            //check for record
            $objMarriageStatus = \App\MarriageStatus::find($user_id);

            if ($objMarriageStatus) {
                $objMarriageStatus->is_married = $is_married;
                $objMarriageStatus->save();
            } else {
                \App\MarriageStatus::create(['user_id' => $user_id, 'is_married' => $is_married]);
            }

            return response()->json(['status' => 200, 'msg' => 'Marriage status has been updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'msg' => 'Error']);
        }
    }

    public function getmarriagestatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objMarriageStatus = \App\MarriageStatus::find($user_id);
            
            return response()->json(['status' => 200, 'data' => $objMarriageStatus]);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'data' => [[]]]);
        }
    }
}
