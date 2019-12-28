<?php

namespace App\Http\Controllers;

use App\User;
use Session, Auth;
use App\PersonalInfo;
use Exception;
use Illuminate\Http\Request;

class PersonalinfoController extends Controller
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
        //get personal information of users
        // $user_id = Auth::user()->id;
        // $personal_info = \App\PersonalInfo::find($user_id)
        //     ->with('UserPhone')
        //     ->with('UserEmail')
        //     ->with('UserSocailMedia')
        //     ->with('UserEmployer')
        //     ->get()
        //     ->toArray();
        
        //, compact($personal_info)
        return view('personalinfo.personalinfo');
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function edit(PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, PersonalInfo $personalInfo)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(PersonalInfo $personalInfo)
    {
        //
    }

    public function personaldetails()
    {
        return view('personalinfo.personalinfo');
    }

    /**
     * 
     */
    public function postpersonaldata(Request $request) {
        // $request->validate([
        //     'title' => 'required|unique:'.$this->table.'|max:191',
        //     'status' => 'required',
        // ]);

        $inputs = $request->all();
        
        //personal information
        $legal_name         = $inputs['legal_name'];
        $nick_name          = $inputs['nickname'];
        $home_address       = $inputs['home_address'];
        $dob                = $inputs['date'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    //\App\UserPhone::create(['user_id' => Auth::user()->id, 'phone' => $phone]);
                    $arrPhone[] = ['user_id' => Auth::user()->id, 'phone' => $phone];
                }
            }
        }

        //email info
        $arrEmail = [];
        if (isset($inputs['email'])) {
            foreach($inputs['email'] as $key => $value) {
                if ($value) {
                    //\App\UserEmail::create(['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]]);
                    $arrEmail[] = ['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]];
                } 
            }
        }

        //social media info
        $arrSocial = [];
        if (isset($inputs['social_media_type'])) {
            foreach($inputs['social_media_type'] as $key => $value) {
                if ($value) {
                    //\App\UserSocailMedia::create(['user_id' => Auth::user()->id, 'social_id' => $value, 'username' => $inputs['social_username'][$key], 'password' => $inputs['social_password'][$key]]);
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

        $arrPersonalInfo = [
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
        ];
        
        try {
            //insert personal information
            $objPersonalInfo = \App\PersonalInfo::create($arrPersonalInfo);
            
            //insert record in user personal details completion
            $arrData = ['step_id' => 1, 'user_id' => Auth::user()->id, 'is_filled' => 1];
            $objPercentageCompletion = \App\UsersPersonalDetailsCompletion::Create($arrData);

            //insert phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\UserPhone::create($phones);
                } 
            }

            //insert email information
            if (!empty($arrEmail)) {
                foreach($arrEmail as $emails) {
                    \App\UserEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                foreach($arrSocial as $socials) {
                    \App\UserSocailMedia::create($socials);
                }
            }
            
            if(!empty($arrEmployer)) {
                foreach($arrEmployer as $employers) {
                    \App\UserEmployer::create($employers);
                }
            }

            //return response()->json(['response' => $inputs, 'phone' => $arrPhone, 'email' => $arrEmail, 'social' => $arrSocial, 'employer' => $arrEmployer]);
            return response()->json(['status' => 200, 'message' => 'Personal information has been saved successfully']);

        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => 503, 'message' => 'Error']);
        }
    }

    public function updatepersonaldata(Request $request, $id) {
        $inputs = $request->all();
        
        //personal information
        $legal_name         = $inputs['legal_name'];
        $nick_name          = $inputs['nickname'];
        $home_address       = $inputs['home_address'];
        $dob                = $inputs['date'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];

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
            //insert personal information
            $objPersonalInfo = \App\PersonalInfo::find($id);
            //$objPersonalInfo->user_id       = Auth::user()->id;
            $objPersonalInfo->legal_name    = $legal_name ? $legal_name : "";
            $objPersonalInfo->nickname      = $nick_name ? $nick_name : "";
            $objPersonalInfo->home_address  = $home_address ? $home_address : "";
            $objPersonalInfo->dob           = $dob ? date('Y-m-d', strtotime($dob)) : "";
            $objPersonalInfo->country_id    = $country_id ? $country_id : "";
            $objPersonalInfo->passport_number = $passport_number ? $passport_number : "";
            $objPersonalInfo->father_name     = $father_name ? $father_name : "";
            $objPersonalInfo->father_birth_place  = $father_birth_place ? $father_birth_place : "";
            $objPersonalInfo->mother_name         = $mother_name ? $mother_name : "";
            $objPersonalInfo->mother_birth_place  = $mother_birth_place ? $mother_birth_place : "";
            $objPersonalInfo->save();

            //insert record in user personal details completion
            \App\UsersPersonalDetailsCompletion::where('step_id', 1)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_filled' => '1']);

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\UserPhone::where('user_id', Auth::user()->id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\UserPhone::create($phones);
                } 
            }

            //insert email information
            if (!empty($arrEmail)) {
                //remove email details
                \App\UserEmail::where('user_id', Auth::user()->id)->delete();

                foreach($arrEmail as $emails) {
                    \App\UserEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                //remove social media info
                \App\UserSocailMedia::where('user_id', Auth::user()->id)->delete();

                foreach($arrSocial as $socials) {
                    \App\UserSocailMedia::create($socials);
                }
            }
            
            if(!empty($arrEmployer)) {
                //remove employer details
                \App\UserEmployer::where('user_id', Auth::user()->id)->delete();

                foreach($arrEmployer as $employers) {
                    \App\UserEmployer::create($employers);
                }
            }

            //return response()->json(['response' => $inputs, 'phone' => $arrPhone, 'email' => $arrEmail, 'social' => $arrSocial, 'employer' => $arrEmployer]);
            return response()->json(['status' => 200, 'message' => 'Personal information has been saved successfully']);

        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => 503, 'message' => 'Error']);
        }
    }

    /**
     * get user personal info
     */
    public function getpersonalinfo() {
        $user_id = Auth::user()->id;
        
        $count = \App\PersonalInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $personal_info = \App\PersonalInfo::find($user_id)
                ->with('UserPhone')
                ->with('UserEmail')
                ->with('UserSocailMedia')
                ->with('UserEmployer')
                ->get();
            
            return response()->json(['status' => 200, 'data' => $personal_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * get user personal info
     */
    public function getuserphones() {
        $user_id = Auth::user()->id;
        $phones = \App\UserPhone::find($user_id)
            ->get();

        return response()->json(['status' => 200, 'data' => $phones]);
    }
}
