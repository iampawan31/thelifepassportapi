<?php

namespace App\Http\Controllers;

use App\User;
use App\PersonalAddress;
use App\PersonalEmployerBenefits;
use Exception;
use App\PersonalInfo;
use App\UserEmail;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

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
        return view('personalinfo.personalinfo', ['user' => auth()->user()]);
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

            $user = User::find(auth()->id());

            // Save user's personal information
            $personalInfo = new PersonalInfo;

            $personalInfo->user_id = $user->id;
            $personalInfo->legal_name = request('legal_name') ?: "";
            $personalInfo->nickname = request('nickname') ?: "";
            $personalInfo->dob = Carbon::parse(request('dob')) ?: "";
            $personalInfo->country_id = request('country_id') ?: "";
            $personalInfo->passport_number = request('passport_number') ?: "";
            $personalInfo->father_name = request('father_name') ?: "";
            $personalInfo->father_birth_place = request('father_birth_place') ?: "";
            $personalInfo->mother_name = request('mother_name') ?: "";
            $personalInfo->mother_birth_place = request('mother_birth_place') ?: "";

            $personalInfo->save();



            // Save user's personal address
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

            //Saving user's phone numbers
            $phoneNumbers = json_decode(request('user_phones'));

            if (isset($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        $user->phones()->create(['user_id' => auth()->id(), 'phone' => $phone->number]);
                    }
                }
            }

            //Saving user's emails
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

            //Saving user's social media details
            $socials = json_decode(request('user_social_media'));

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

            //Saving user's employment details
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

                        if (isset($employer->employer_address)) {
                            $employment->address()->create([
                                'user_id' => $user->id,
                                'street_address1' => $employer->address->street_address1,
                                'street_address2' => $employer->address->street_address2,
                                'city' => $employer->address->city,
                                'state' => $employer->address->state,
                                'zipcode' => $employer->address->zipcode,
                            ]);
                        }

                        $benefits = $employer->benefits;

                        if (isset($benefits)) {
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
            }

            // Save step completed information
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
                    'status' => 201,
                    'message' => 'Personal information has been saved successfully'
                ], 201);
        } catch (Exception $e) {
            DB::rollBack();

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
     * @return \Illuminate\Http\Response
     */
    public function show()
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
        if ($personalInfo && $personalInfo->user_id == auth()->id()) {
            try {
                $user = User::findOrFail(auth()->id());


                DB::beginTransaction();

                $personalInfo->legal_name = request('legal_name') ?: "";
                $personalInfo->nickname = request('nickname') ?: "";
                $personalInfo->dob = Carbon::parse(request('dob')) ?: "";
                $personalInfo->country_id = request('country_id') ?: "";
                $personalInfo->passport_number = request('passport_number') ?: "";
                $personalInfo->father_name = request('father_name') ?: "";
                $personalInfo->father_birth_place = request('father_birth_place') ?: "";
                $personalInfo->mother_name = request('mother_name') ?: "";
                $personalInfo->mother_birth_place = request('mother_birth_place') ?: "";

                $personalInfo->save();

                // Save user's personal address
                $homeAddress = request('personal_address');


                if (isset($homeAddress)) {
                    PersonalAddress::updateOrCreate([
                        'user_id' => $user->id,
                    ], [
                        'street_address1' => $homeAddress['street_address1'] ?: "",
                        'street_address2' => $homeAddress['street_address2'] ?: "",
                        'city' => $homeAddress['city'] ?: "",
                        'state' => $homeAddress['state'] ?: "",
                        'zipcode' => $homeAddress['zipcode'] ?: "",
                    ]);
                }

                // Updating user's phone numbers
                $phoneNumbers = request('user_phones');

                if (isset($phoneNumbers)) {
                    $user->phones()->delete();

                    foreach ($phoneNumbers as $phone) {
                        if ($phone) {
                            $user->phones()->updateOrCreate(['user_id' => auth()->id(), 'phone' => $phone->number]);
                        }
                    }
                }

                // Updating user's emails
                $emails = request('emails');

                if (isset($emails)) {
                    UserEmail::where('user_id', $user->id)->delete();

                    dd($user->emails);

                    foreach ($emails as $email) {
                        if ($email) {
                            $user->emails()->updateOrCreate(
                                [
                                    'user_id' => auth()->id(),
                                    'email' => $email->email,
                                    'password' => $email->password
                                ]
                            );
                        }
                    }
                }

                //Updating user's social media details
                $socials = request('user_social_media');

                if (isset($socials)) {
                    $user->socials()->delete();

                    foreach ($socials as $social) {
                        if ($social) {
                            $user->socials()->updateOrCreate(
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

                //Updating user's employment details
                $employers = request('user_employer');

                if (isset($employers)) {
                    $user->employers()->delete();

                    foreach ($employers as $employer) {
                        if ($employer) {
                            $employment = $user->employers()->updateOrCreate([
                                'user_id' => auth()->id(),
                                'employer_name' => $employer->employer_name,
                                'employer_phone' => $employer->employer_phone,
                                'computer_username' => $employer->computer_username,
                                'computer_password' => $employer->computer_password
                            ]);

                            if (isset($employer->employer_address)) {
                                $employment->address()->updateOrCreate([
                                    'user_id' => $user->id,
                                    'street_address1' => $employer->address->street_address1,
                                    'street_address2' => $employer->address->street_address2,
                                    'city' => $employer->address->city,
                                    'state' => $employer->address->state,
                                    'zipcode' => $employer->address->zipcode,
                                ]);
                            }

                            $benefits = $employer->benefits;

                            if (isset($benefits)) {
                                foreach ($benefits as $benefit) {
                                    PersonalEmployerBenefits::updateOrCreate([
                                        'user_id' => $user->id,
                                        'employer_id' => $employment->id,
                                        'benefit_id' => $benefit
                                    ]);
                                }
                            }
                        }
                    }
                }

                // Save step completed information
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
                        'status' => 201,
                        'message' => 'Personal information has been saved successfully'
                    ], 201);
            } catch (Exception $e) {
                Log::error('createProcess() ERROR: ' . $e->getMessage(), $request->all());
                DB::rollBack();

                return response()
                    ->json([
                        'status' => 500,
                        'message' => $e
                    ], 500);
            }
        }
    }
}
