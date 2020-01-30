<?php

namespace App\Http\Controllers\Api;

use App\EmployerAddress;
use App\Http\Controllers\Controller;
use App\PersonalAddress;
use App\PersonalEmployerBenefits;
use App\PersonalInfo;
use App\User;
use App\UserEmail;
use App\UserEmployer;
use App\UserPhone;
use App\UserSocialMedia;
use App\UsersPersonalDetailsCompletion;
use Exception;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PersonalInfoController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
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

            if (!empty($homeAddress)) {
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

            if (!empty($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        $user->phones()->create(['user_id' => auth()->id(), 'phone' => $phone->phone]);
                    }
                }
            }

            //Saving user's emails
            $emails = json_decode(request('emails'));
            if (!empty($emails)) {
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

            if (!empty($socials)) {
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

            if (!empty($employers)) {
                foreach ($employers as $employer) {
                    if ($employer) {
                        $employment = $user->employers()->create([
                            'user_id' => auth()->id(),
                            'employer_name' => $employer->employer_name,
                            'employer_phone' => $employer->employer_phone,
                            'computer_username' => $employer->computer_username,
                            'computer_password' => $employer->computer_password
                        ]);

                        if (!empty($employer->address)) {
                            $employment->address()->create([
                                'user_id' => $user->id,
                                'street_address1' => $employer->address->street_address1,
                                'street_address2' => $employer->address->street_address2,
                                'city' => $employer->address->city,
                                'state' => $employer->address->state,
                                'zipcode' => $employer->address->zipcode,
                            ]);
                        }

                        if (!empty($employer->benefits)) {
                            $benefits = $employer->benefits;
                            foreach ($benefits as $benefit) {
                                $employment->benefits()->attach($benefit->id);
//                            PersonalEmployerBenefits::create([
//                                'employer_id' => $employment->id,
//                                'benefit_id' => $benefit->id
//                            ]);
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
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonalInfo $personalInfo
     * @return \Illuminate\Http\Response
     */
    public function update(PersonalInfo $personalInfo)
    {
        // TODO:: Update Personal Information
        // TODO:: Update Personal Address
        // TODO:: Update Phone Numbers
        // TODO:: Update Emails
        // TODO:: Update Social Media Details

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
                $homeAddress = json_decode(request('personal_address'));


                if (!empty($homeAddress)) {
                    $personalAddress = PersonalAddress::updateOrCreate([
                        'user_id' => $user->id,
                    ], [
                        'street_address1' => $homeAddress->street_address1 ?: "",
                        'street_address2' => $homeAddress->street_address2 ?: "",
                        'city' => $homeAddress->city ?: "",
                        'state' => $homeAddress->state ?: "",
                        'zipcode' => $homeAddress->zipcode ?: "",
                    ]);
                }

                // Updating user's phone numbers
                $phoneNumbers = json_decode(request('user_phones'));

                if (!empty($phoneNumbers)) {
                    UserPhone::where('user_id', $user->id)->delete();
                    foreach ($phoneNumbers as $phone) {
                        if (!empty($phone)) {
                            UserPhone::create(['user_id' => $user->id, 'phone' => $phone->phone]);
                        }
                    }
                }

                // Updating user's emails
                $emails = json_decode(request('user_emails'));

                if (!empty($emails)) {
                    UserEmail::where('user_id', $user->id)->delete();

                    foreach ($emails as $email) {
                        if (!empty($email)) {
                            UserEmail::create(['user_id' => $user->id, 'email' => $email->email, 'password' => $email->password]);
                        }
                    }
                }

                //Updating user's social media details
                $socials = json_decode(request('user_social_media'));

                if (!empty($socials)) {
                    UserSocialMedia::where('user_id', $user->id)->delete();

                    foreach ($socials as $social) {
                        if (!empty($social) && $social->social_id !== null) {
                            UserSocialMedia::create([
                                'user_id' => $user->id,
                                'social_id' => $social->social_id,
                                'username' => $social->username,
                                'password' => $social->password]);
                        }
                    }
                }

                //Updating user's employment details
                $employers = json_decode(request('user_employer'));

                if (!empty($employers)) {
//                    UserEmployer::where('user_id', $user->id)->delete();

                    foreach ($employers as $employer) {
                        if (!empty($employer)) {
                            if ($employer->id) {
                                $userEmployer = UserEmployer::updateOrCreate([
                                    'id' => $employer->id,
                                    'user_id' => $user->id], [
                                    'employer_name' => $employer->employer_name,
                                    'employer_phone' => $employer->employer_phone,
                                    'computer_username' => $employer->computer_username,
                                    'computer_password' => $employer->computer_password
                                ]);
                            } else {
                                $userEmployer = UserEmployer::create([
                                    'user_id' => $user->id], [
                                    'employer_name' => $employer->employer_name,
                                    'employer_phone' => $employer->employer_phone,
                                    'computer_username' => $employer->computer_username,
                                    'computer_password' => $employer->computer_password
                                ]);
                            }

                            if (!empty($employer->employer_address)) {
                                EmployerAddress::updateOrCreate([
                                    'user_id' => $user->id,
                                    'employer_id' => $userEmployer->id
                                ], [
                                    'street_address1' => $employer->address->street_address1,
                                    'street_address2' => $employer->address->street_address2,
                                    'city' => $employer->address->city,
                                    'state' => $employer->address->state,
                                    'zipcode' => $employer->address->zipcode,
                                ]);
                            }

                            if (!empty($employer->benefits)) {
                                $benefitsSelected = $this->getSelectedBenefits($employer->benefits);
                                $userEmployer->benefits()->sync($benefitsSelected);
                            }

                        }
                    }
                }

                // Save step completed information
                UsersPersonalDetailsCompletion::updateOrCreate([
                    'step_id' => 1,
                    'user_id' => $user->id
                ], [
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
            } catch
            (Exception $e) {
                DB::rollBack();

                return response()
                    ->json([
                        'status' => 500,
                        'message' => $e
                    ], 500);
            }
        }
        return response()
            ->json(['status' => 500,
                'message' => "Something went wrong. Error Code APIC#358"], 500);
    }

    public function getSelectedBenefits($benefits)
    {
        $selectedBenefits = [];
        foreach ($benefits as $key => $value) {
            $selectedBenefits[$key] = $value->id;
        }

        return $selectedBenefits;
    }
}
