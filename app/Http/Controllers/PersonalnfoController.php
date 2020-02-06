<?php

namespace App\Http\Controllers;

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
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class PersonalInfoController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        return view('personal.info', ['user' => auth()->user()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return JsonResponse
     */
    public function store()
    {
        try {

            DB::beginTransaction();

            $user = User::find(auth()->id());

            // Save user's personal information
            $personalInfo = new PersonalInfo;

            $personalInfo->user_id = $user->id;

            $this->updatePersonalInformation($personalInfo);

            // Save user's personal address
            $homeAddress = json_decode(request('personal_address'));

            if (!empty($homeAddress)) {
                $this->updatePersonalAddress($user, $homeAddress);
            }

            //Saving user's phone numbers
            $phoneNumbers = json_decode(request('phones'));

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
                            }
                        }
                    }
                }
            }

            // Save step completed information
            $user->steps()->syncWithoutDetaching([1 => [
                'user_id' => $user->id,
                'is_visited' => '1',
                'is_filled' => '1',
                'is_completed' => request('is_completed') ? 1 : 0
            ]]);

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
     * @return JsonResponse
     */
    public function show()
    {
        return response()->json(['status' => 200, 'data' => auth()->user(), 'is_completed' => auth()->user()->stepCompleted(1)]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param PersonalInfo $personalInfo
     * @return JsonResponse
     */
    public function update(PersonalInfo $personalInfo)
    {
        if ($personalInfo && $personalInfo->user_id == auth()->id()) {
            try {
                $user = User::findOrFail(auth()->id());

                DB::beginTransaction();

                $this->updatePersonalInformation($personalInfo);

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
                        if (!empty($phone) && $phone->phone !== null) {
                            UserPhone::create(['user_id' => $user->id, 'phone' => $phone->phone]);
                        }
                    }
                }

                // Updating user's emails
                $emails = json_decode(request('user_emails'));

                if (!empty($emails)) {
                    UserEmail::where('user_id', $user->id)->delete();

                    foreach ($emails as $email) {
                        if (!empty($email) && $email->email !== null) {
                            UserEmail::create([
                                'user_id' => $user->id,
                                'email' => $email->email,
                                'password' => $email->password
                            ]);
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
                                'password' => $social->password
                            ]);
                        }
                    }
                }

                //Updating user's employment details
                $employers = json_decode(request('user_employer'));

                if (!empty($employers)) {
                    foreach ($employers as $employer) {
                        if (!empty($employer) && $employer->employer_name !== null) {
                            if (!empty($employer->id)) {
                                $userEmployer = UserEmployer::updateOrCreate([
                                    'id' => $employer->id,
                                    'user_id' => $user->id
                                ], [
                                    'employer_name' => $employer->employer_name,
                                    'employer_phone' => $employer->employer_phone,
                                    'computer_username' => $employer->computer_username,
                                    'computer_password' => $employer->computer_password
                                ]);
                            } else {
                                $userEmployer = UserEmployer::create([
                                    'user_id' => $user->id,
                                    'employer_name' => $employer->employer_name,
                                    'employer_phone' => $employer->employer_phone,
                                    'computer_username' => $employer->computer_username,
                                    'computer_password' => $employer->computer_password
                                ]);
                            }

                            if (!empty($employer->address)) {
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
                $user->steps()->syncWithoutDetaching(1, [
                    'user_id' => $user->id,
                    'is_visited' => '1',
                    'is_filled' => '1',
                    'is_completed' => request('is_completed') ? '1':'0'
                ]);

                DB::commit();

                return response()
                    ->json([
                        'status' => 201,
                        'message' => 'Personal information has been updated successfully'
                    ], 201);
            } catch (Exception $e) {
                dd($e);
                DB::rollBack();

                return response()
                    ->json([
                        'status' => 500,
                        'message' => $e
                    ], 422);
            }
        }
        return response()
            ->json([
                'status' => 500,
                'message' => "Something went wrong. Error Code APIC#332"
            ], 500);
    }

    protected function getSelectedBenefits($benefits)
    {
        $selectedBenefits = [];
        foreach ($benefits as $key => $value) {
            $selectedBenefits[$key] = $value->id;
        }

        return $selectedBenefits;
    }

    /**
     * @param PersonalInfo $personalInfo
     */
    protected function updatePersonalInformation(PersonalInfo $personalInfo): void
    {
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
    }

    /**
     * @param $user
     * @param $homeAddress
     */
    protected function updatePersonalAddress($user, $homeAddress)
    {
        return PersonalAddress::updateOrCreate(['user_id' => auth()->id()], [
            'user_id' => $user->id,
            'street_address1' => $homeAddress->street_address1 ?: "",
            'street_address2' => $homeAddress->street_address2 ?: "",
            'city' => $homeAddress->city ?: "",
            'state' => $homeAddress->state ?: "",
            'zipcode' => $homeAddress->zipcode ?: "",
        ]);
    }
}
