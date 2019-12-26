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
        $user_id = Auth::user()->id;
        $personal_info = \App\PersonalInfo::find($user_id)
            ->with('UserPhone')
            ->with('UserEmail')
            ->with('UserSocailMedia')
            ->with('UserEmployer')
            ->get()
            ->toArray();
        
        return view('personalinfo.personalinfo', compact($personal_info));
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
            $arrData = ['step_id' => 1, 'user_id' => Auth::user()->id];
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
}
