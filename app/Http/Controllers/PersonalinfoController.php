<?php

namespace App\Http\Controllers;

use App\User;
use App\UserEmail;
use App\PersonalAddress;
use App\PersonalEmployerBenefits;
use Exception;
use Auth;
use App\PersonalInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PersonalInfoController extends Controller
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
     * Display the Personal Information Page.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('personalinfo.personalinfo');
    }

    /**
     * Save User's Personal Information.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {

            DB::beginTransaction();

            $user = User::find(auth()->id())->first();

            // Save User's Personal Information
            $personaInfo = new PersonalInfo;

            $personaInfo->user_id = $user->id;
            $personaInfo->legal_name = request('legal_name') ?: "";
            $personaInfo->nickname = request('nickname') ?: "";
            $personaInfo->dob = Carbon::parse(request('dob')) ?: "";
            $personaInfo->country_id = request('citizenship') ?: "";
            $personaInfo->passport_number = request('passport_number') ?: "";
            $personaInfo->father_name = request('father_name') ?: "";
            $personaInfo->father_birth_place = request('father_birth_place') ?: "";
            $personaInfo->mother_name = request('mother_name') ?: "";
            $personaInfo->mother_birth_place = request('mother_birth_place') ?: "";

            $personaInfo->save();

            // Save User's Personal Address
            $homeAddress = json_decode(request('personal_address'));

            if (isset($homeAddress)) {
                $personalAddress = new PersonalAddress;

                $personalAddress->user_id = $user->id;
                $personalAddress->street_address1 = $homeAddress->street_address1 ?: "";
                $personalAddress->street_address2 = $homeAddress->street_address2 ?: "";
                $personalAddress->city = $homeAddress->city ?: "";
                $personalAddress->state = $homeAddress->state ?: "";
                $personalAddress->zipcode = $homeAddress->zipcode ?: "";

                $personalAddress->save();
            }

            //Saving User's Phone Numbers
            $phoneNumbers = json_decode(request('user_phones'));

            if (isset($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        $user->phones()->create(['user_id' => auth()->id(), 'phone' => $phone->number]);
                    }
                }
            }

            //Saving User's Emails
            $emails = json_decode(request('emails'));
            if (isset($emails)) {
                foreach ($emails as $email) {
                    if ($email) {
                        $user->emails()->create(
                            [
                                'user_id' => auth()->id(),
                                'email' => $email->email,
                                'password' => $email->password
                            ]
                        );
                    }
                }
            }

            //Saving User's Social Media Details
            $socials = json_decode(request('user_socail_media'));

            if (isset($socials)) {
                foreach ($socials as $social) {
                    if ($social) {
                        $user->socials()->create(
                            [
                                'user_id' => auth()->id(),
                                'social_id' => $social->social_id,
                                'username' => $social->username,
                                'password' => $social->password
                            ]
                        );
                    }
                }
            }

            //Saving User's Social Media Details
            $employers = json_decode(request('user_employer'));

            if (isset($employers)) {
                foreach ($employers as $employer) {
                    if ($employer) {
                        $employment = $user->employers()->create([
                            'user_id' => auth()->id(),
                            'employer_name' => $employer->employer_name,
                            'employer_phone' => $employer->employer_phone,
                            'computer_username' => $employer->computer_username,
                            'computer_password' => $employer->computer_password
                        ]);

                        $employment->address()->create([
                            'user_id' => $user->id,
                            'street_address1' => $employer->employer_address->street_address1,
                            'street_address2' => $employer->employer_address->street_address2,
                            'city' => $employer->employer_address->city,
                            'state' => $employer->employer_address->state,
                            'zipcode' => $employer->employer_address->zipcode,
                        ]);

                        $benefits = $employer->benefits;

                        foreach ($benefits as $benefit) {
                            PersonalEmployerBenefits::create([
                                'user_id' => $user->id,
                                'employer_id' => $employment->id,
                                'benefit_id' => $benefit
                            ]);
                        }
                    }
                }
            }

            // Save Step Completed Information
            $user->steps()->create([
                'step_id' => 1,
                'user_id' => $user->id,
                'is_visited' => '1',
                'is_filled' => '1',
                'is_completed' => request('is_completed') ? 1 : 0
            ]);

            DB::commit();

            return response()
                ->json([
                    'status' => 200,
                    'message' => 'Personal information has been saved successfully'
                ], 200);
        } catch (Exception $e) {
            DB::rollBack();
            dd($e);
            return response()
                ->json([
                    'status' => 500,
                    'message' => $e
                ], 500);
        }
    }

    /**
     * Get Personal Information Details.
     *
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function show(PersonalInfo $personalInfo)
    {
        return response()->json(['status' => 200, 'data' => auth()->user()]);
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
        $inputs = $request->all();

        //personal information
        $legal_name         = $inputs['legal_name'];
        $nick_name          = $inputs['nickname'];
        $street_address_1   = $inputs['personal_street_address_1'];
        $street_address_2   = $inputs['personal_street_address_2'];
        $city               = $inputs['personal_city'];
        $state              = $inputs['personal_state'];
        $zipcode            = $inputs['personal_zipcode'];
        $dob                = $inputs['date'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];
        $is_completed       = @$inputs['chk_complete'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach ($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => Auth::user()->id, 'phone' => $phone];
                }
            }
        }

        //email info
        $arrEmail = [];
        if (isset($inputs['email'])) {
            foreach ($inputs['email'] as $key => $value) {
                if ($value) {
                    $arrEmail[] = ['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]];
                }
            }
        }

        //social media info
        $arrSocial = [];
        if (isset($inputs['social_media_type'])) {
            foreach ($inputs['social_media_type'] as $key => $value) {
                if ($value) {
                    $arrSocial[] = ['user_id' => Auth::user()->id, 'social_id' => $value, 'username' => $inputs['social_username'][$key], 'password' => $inputs['social_password'][$key]];
                }
            }
        }

        //employer info
        $arrEmployer = [];
        if (isset($inputs['employer_name'])) {
            foreach ($inputs['employer_name'] as $key => $value) {
                if (!empty($value)) {
                    $arrEmployer[] = [
                        'user_id'                   => Auth::user()->id,
                        'employer_name'             => $value,
                        'employer_phone'            => $inputs['employer_phone'][$key],
                        'employer_address'          => @$inputs['employer_address'][$key],
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
            $objPersonalInfo->legal_name            = $legal_name ? $legal_name : "";
            $objPersonalInfo->nickname              = $nick_name ? $nick_name : "";
            $objPersonalInfo->home_address          = @$home_address ? $home_address : "";
            $objPersonalInfo->street_address1       = $street_address_1 ? $street_address_1 : "";
            $objPersonalInfo->street_address2       = $street_address_2 ? $street_address_2 : "";
            $objPersonalInfo->city                  = $city ? $city : "";
            $objPersonalInfo->state                 = $state ? $state : "";
            $objPersonalInfo->zipcode               = $zipcode ? $zipcode : "";
            $objPersonalInfo->dob                   = $dob ? date('Y-m-d', strtotime($dob)) : Null;
            $objPersonalInfo->country_id            = $country_id ? $country_id : 0;
            $objPersonalInfo->passport_number       = $passport_number ? $passport_number : "";
            $objPersonalInfo->father_name           = $father_name ? $father_name : "";
            $objPersonalInfo->father_birth_place    = $father_birth_place ? $father_birth_place : "";
            $objPersonalInfo->mother_name           = $mother_name ? $mother_name : "";
            $objPersonalInfo->mother_birth_place    = $mother_birth_place ? $mother_birth_place : "";
            $objPersonalInfo->save();

            //insert record in user personal details completion
            $is_completed = $is_completed ? '1' : '0';
            \App\UsersPersonalDetailsCompletion::where('step_id', 1)
                ->where('user_id', Auth::user()->id)
                ->update(['is_visited' => '1', 'is_filled' => '1', 'is_completed' => $is_completed]);

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\UserPhone::where('user_id', Auth::user()->id)->delete();
                foreach ($arrPhone as $phones) {
                    $objPhone = \App\UserPhone::create($phones);
                }
            }

            //insert email information
            if (!empty($arrEmail)) {
                //remove email details
                \App\UserEmail::where('user_id', Auth::user()->id)->delete();

                foreach ($arrEmail as $emails) {
                    \App\UserEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                //remove social media info
                \App\UserSocialMedia::where('user_id', Auth::user()->id)->delete();

                foreach ($arrSocial as $socials) {
                    \App\UserSocialMedia::create($socials);
                }
            }

            if (!empty($arrEmployer)) {
                //remove employer details
                \App\UserEmployer::where('user_id', Auth::user()->id)->delete();

                foreach ($arrEmployer as $employers) {
                    \App\UserEmployer::create($employers);
                }
            }

            return response()->json(['status' => 200, 'message' => 'Personal information has been saved successfully'], 200);
        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => 500, 'message' => 'Error'], 500);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\PersonalInfo  $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function updatepersonaldata(Request $request, $id)
    {
        $inputs = $request->all();

        //personal information
        $legal_name         = $inputs['legal_name'];
        $nick_name          = $inputs['nickname'];
        $home_address       = $inputs['home_address'];
        $street_address_1   = $inputs['street_address_1'];
        $street_address_2   = $inputs['street_address_2'];
        $city               = $inputs['city'];
        $state              = $inputs['state'];
        $zipcode            = $inputs['zipcode'];
        $dob                = $inputs['date'];
        $country_id         = @$inputs['citizenship'];
        $passport_number    = $inputs['passport_number'];
        $father_name        = $inputs['father_name'];
        $father_birth_place = $inputs['father_birth_place'];
        $mother_name        = $inputs['mother_name'];
        $mother_birth_place = $inputs['mother_birth_place'];
        $is_completed       = @$inputs['chk_complete'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach ($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => Auth::user()->id, 'phone' => $phone];
                }
            }
        }

        //email info
        $arrEmail = [];
        if (isset($inputs['email'])) {
            foreach ($inputs['email'] as $key => $value) {
                if ($value) {
                    $arrEmail[] = ['user_id' => Auth::user()->id, 'email' => $value, 'password' => $inputs['email_password'][$key]];
                }
            }
        }

        //social media info
        $arrSocial = [];
        if (isset($inputs['social_media_type'])) {
            foreach ($inputs['social_media_type'] as $key => $value) {
                if ($value) {
                    $arrSocial[] = ['user_id' => Auth::user()->id, 'social_id' => $value, 'username' => $inputs['social_username'][$key], 'password' => $inputs['social_password'][$key]];
                }
            }
        }

        //employer info
        $arrEmployer = [];
        if (isset($inputs['employer_name'])) {
            foreach ($inputs['employer_name'] as $key => $value) {
                if (!empty($value)) {
                    $arrEmployer[] = [
                        'user_id'                   => Auth::user()->id,
                        'employer_name'             => $value,
                        'employer_phone'            => $inputs['employer_phone'][$key],
                        'employer_address'          => @$inputs['employer_address'][$key],
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
            $objPersonalInfo->legal_name            = $legal_name ? $legal_name : "";
            $objPersonalInfo->nickname              = $nick_name ? $nick_name : "";
            $objPersonalInfo->home_address          = @$home_address ? $home_address : "";
            $objPersonalInfo->street_address1       = $street_address_1 ? $street_address_1 : "";
            $objPersonalInfo->street_address2       = $street_address_2 ? $street_address_2 : "";
            $objPersonalInfo->city                  = $city ? $city : "";
            $objPersonalInfo->state                 = $state ? $state : "";
            $objPersonalInfo->zipcode               = $zipcode ? $zipcode : "";
            $objPersonalInfo->dob                   = $dob ? date('Y-m-d', strtotime($dob)) : Null;
            $objPersonalInfo->country_id            = $country_id ? $country_id : 0;
            $objPersonalInfo->passport_number       = $passport_number ? $passport_number : "";
            $objPersonalInfo->father_name           = $father_name ? $father_name : "";
            $objPersonalInfo->father_birth_place    = $father_birth_place ? $father_birth_place : "";
            $objPersonalInfo->mother_name           = $mother_name ? $mother_name : "";
            $objPersonalInfo->mother_birth_place    = $mother_birth_place ? $mother_birth_place : "";
            $objPersonalInfo->save();

            //insert record in user personal details completion
            $is_completed = $is_completed ? '1' : '0';
            \App\UsersPersonalDetailsCompletion::where('step_id', 1)
                ->where('user_id', Auth::user()->id)
                ->update(['is_visited' => '1', 'is_filled' => '1', 'is_completed' => $is_completed]);

            //insert phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\UserPhone::where('user_id', Auth::user()->id)->delete();
                foreach ($arrPhone as $phones) {
                    $objPhone = \App\UserPhone::create($phones);
                }
            }

            //insert email information
            if (!empty($arrEmail)) {
                //remove email details
                \App\UserEmail::where('user_id', Auth::user()->id)->delete();

                foreach ($arrEmail as $emails) {
                    \App\UserEmail::create($emails);
                }
            }

            //insert email information
            if (!empty($arrSocial)) {
                //remove social media info
                \App\UserSocialMedia::where('user_id', Auth::user()->id)->delete();

                foreach ($arrSocial as $socials) {
                    \App\UserSocialMedia::create($socials);
                }
            }

            if (!empty($arrEmployer)) {
                //remove employer details
                \App\UserEmployer::where('user_id', Auth::user()->id)->delete();

                foreach ($arrEmployer as $employers) {
                    \App\UserEmployer::create($employers);
                }
            }

            return response()->json(['status' => 200, 'message' => 'Personal information has been saved successfully'], 200);
        } catch (Exception $e) {
            dd($e);
            return response()->json(['status' => 500, 'message' => 'Error'], 500);
        }
    }
}
