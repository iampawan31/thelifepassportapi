<?php

namespace App\Http\Controllers;

use App\PersonalInfo;
use App\SpouseAddress;
use App\SpouseEmail;
use App\SpouseEmployer;
use App\SpouseEmployerAddress;
use App\SpouseEmployerBenefits;
use App\SpouseInfo;
use App\SpousePhone;
use App\SpouseSocialMedia;
use App\User;
use App\UsersPersonalDetailsCompletion;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class SpouseInfoController extends Controller
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
     * @return JsonResponse
     */
    public function index()
    {
        $spouse_info = SpouseInfo::where('user_id', auth()->id())->first();

        return response()->json([
            'status' => 200,
            'data' => $spouse_info,
            'is_completed' => auth()->user()->stepCompleted(2)
        ], 200);
    }

    /**
     * Store Spouse Information.
     *
     * @param \Illuminate\Http\Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        //TODO:: Store Spouse Personal Info
        //TODO:: Store Address
        //TODO:: Store Phone Numbers
        //TODO:: Store Emails
        //TODO:: Store Social Media,
        //TODO:: Store Employer Information
        //TODO:: Store Employer Address
        //TODO:: Store Employer Benefits/
        //TODO:: Update Step Information
        try {
           DB::beginTransaction();

            $user = auth()->user();
            // Save user's personal information
            $spouseInfo = new SpouseInfo;

            $spouseInfo->user_id = $user->id;
            $this->updateSpouseInformation($spouseInfo);

            // Save user's personal address
            $homeAddress = json_decode(request('spouse_address'));

            if (!empty($homeAddress) && !empty($homeAddress->street_address1)) {
                $spouseAddress = new SpouseAddress;

                $spouseAddress->user_id = $user->id;
                $spouseAddress->street_address1 = $homeAddress->street_address1 ?: "";
                $spouseAddress->street_address2 = $homeAddress->street_address2 ?: "";
                $spouseAddress->city = $homeAddress->city ?: "";
                $spouseAddress->state = $homeAddress->state ?: "";
                $spouseAddress->zipcode = $homeAddress->zipcode ?: "";

                $spouseAddress->save();
            }

            //Saving user's phone numbers
            $phoneNumbers = json_decode(request('phones'));

            if (!empty($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if (!empty($phone->phone)) {
                        //$spouseInfo->phones()->create(['user_id' => $user->id, 'phone' => $phone->phone]);
                        SpousePhone::create(['user_id' => $user->id, 'phone' => $phone->phone]);
                    }
                }
            }

            //Saving user's emails
            $emails = json_decode(request('emails'));
            if (!empty($emails)) {
                foreach ($emails as $email) {
                    if (!empty($email->email)) {
                        // $spouseInfo->emails()->create(
                        //     [
                        //         'user_id' => $user->id, 
                        //         'email' => $email->email,
                        //         'password' => $email->password
                        //     ]
                        // );
                        
                        SpouseEmail::create(
                                [
                                    'user_id' => $user->id, 
                                    'email' => $email->email,
                                    'password' => $email->password
                                ]
                        );
                    
                    }
                }
            }

            //Saving user's social media details
            $socials = json_decode(request('spouse_social_media'));

            if (!empty($socials)) {
                foreach ($socials as $social) {
                    if (!empty($social->social_id)) {
                        // $spouseInfo->socials()->create(
                        //     [
                        //         'user_id' => $user->id, 
                        //         'social_id' => $social->social_id,
                        //         'username' => $social->username,
                        //         'password' => $social->password
                        //     ]
                        // );

                        SpouseSocialMedia::create(
                            [
                                'user_id' => $user->id, 
                                'social_id' => $social->social_id,
                                'username' => $social->username,
                                'password' => $social->password
                            ]
                        );
                    }
                }
            }

            //Saving user's employment details
            $employers = json_decode(request('spouse_employer'));

            if (!empty($employers)) {
                foreach ($employers as $employer) {
                    if (!empty($employer->employer_name)) {

                        $employment = new SpouseEmployer();
                        $employment->user_id = auth()->id();
                        $employment->employer_name = $employer->employer_name;
                        $employment->employer_phone = $employer->employer_phone;
                        $employment->computer_username = $employer->computer_username;
                        $employment->computer_password = $employer->computer_password;
                        $employment->save();

                        if (!empty($employer->address->street_address1)) {
                            $employerAddresss = new SpouseEmployerAddress();
                            $employerAddresss->user_id = auth()->id();
                            $employerAddresss->employer_id = $employment->id;
                            $employerAddresss->street_address1 = $employer->address->street_address1;
                            $employerAddresss->street_address2 = $employer->address->street_address2;
                            $employerAddresss->city = $employer->address->city;
                            $employerAddresss->state = $employer->address->state;
                            $employerAddresss->zipcode = $employer->address->zipcode;
                            $employerAddresss->save();
                        }

                        if (!empty($employer->benefits)) {
                            $benefits = $employer->benefits;
                            foreach ($benefits as $benefit) {
                                $employerBenefits = new SpouseEmployerBenefits();
                                $employerBenefits->employer_id = $employment->id;
                                $employerBenefits->benefit_id = $benefit->id;
                                $employerBenefits->save();
                            }
                        }

                        // $employment = $spouseInfo->employers()->create([
                        //     'user_id' => auth()->id(),
                        //     'employer_name' => $employer->employer_name,
                        //     'employer_phone' => $employer->employer_phone,
                        //     'computer_username' => $employer->computer_username,
                        //     'computer_password' => $employer->computer_password
                        // ]);

                        // if (!empty($employer->address->street_address1)) {
                        //     $employment->address()->create([
                        //         'user_id' => auth()->id(),
                        //         'street_address1' => $employer->address->street_address1,
                        //         'street_address2' => $employer->address->street_address2,
                        //         'city' => $employer->address->city,
                        //         'state' => $employer->address->state,
                        //         'zipcode' => $employer->address->zipcode,
                        //     ]);
                        // }

                        // if (!empty($employer->benefits)) {
                        //     $benefits = $employer->benefits;
                        //     foreach ($benefits as $benefit) {
                        //         $employment->benefits()->attach($benefit->id);
                        //     }
                        // }
                    }
                }
            }

            // Save step completed information
            $user->steps()->syncWithoutDetaching([2 => [
                'user_id' => $user->id,
                'is_visited' => 1,
                'is_filled' => 1,
                'is_completed' => request('is_completed') ? 1 : 0
            ]]);

            DB::commit();

            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Spouse information has been saved successfully'
                ], 201);
        } catch (Exception $e) {dd($e);
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
        $count = SpouseInfo::where('user_id', $id)->get()->count();
        if ($count > 0) {
            $spouse_info = PersonalInfo::find($id)
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
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param SpouseInfo $spouseInfo
     * @return JsonResponse
     */
    public function update(Request $request, $id)
    { 
        //DB::beginTransaction();

        $spouseInfo = SpouseInfo::find($id);
        
        $this->updateSpouseInformation($spouseInfo);
        
        // Update spouse's personal address
        $homeAddress = json_decode(request('spouse_address'));

        if (!empty($homeAddress)) {
            $personalAddress = SpouseAddress::updateOrCreate([
                'user_id' => $spouseInfo->user_id,
            ], [
                'street_address1' => $homeAddress->street_address1 ?: "",
                'street_address2' => $homeAddress->street_address2 ?: "",
                'city' => $homeAddress->city ?: "",
                'state' => $homeAddress->state ?: "",
                'zipcode' => $homeAddress->zipcode ?: "",
            ]);
        }

        // Updating spouse's phone numbers
        $phoneNumbers = json_decode(request('phones'));

        if (!empty($phoneNumbers)) {
            SpousePhone::where('user_id', $spouseInfo->user_id)->delete();
            foreach ($phoneNumbers as $phone) {
                if (!empty($phone) && $phone->phone !== null) {
                    SpousePhone::create(['user_id' => $spouseInfo->user_id, 'phone' => $phone->phone]);
                }
            }
        }

        // Updating user's emails
        $emails = json_decode(request('emails'));

        if (!empty($emails)) {
            SpouseEmail::where('user_id', $spouseInfo->user_id)->delete();

            foreach ($emails as $email) {
                if (!empty($email) && $email->email !== null) {
                    SpouseEmail::create([
                        'user_id' => $spouseInfo->user_id,
                        'email' => $email->email,
                        'password' => $email->password
                    ]);
                }
            }
        }

        //Updating spouse's social media details
        $socials = json_decode(request('spouse_social_media'));

        if (!empty($socials)) {
            SpouseSocialMedia::where('user_id', $spouseInfo->user_id)->delete();

            foreach ($socials as $social) {
                if (!empty($social) && $social->social_id !== null) {
                    SpouseSocialMedia::create([
                        'user_id' => $spouseInfo->user_id,
                        'social_id' => $social->social_id,
                        'username' => $social->username,
                        'password' => $social->password
                    ]);
                }
            }
        }

        //Updating user's employment details
        $employers = json_decode(request('spouse_employer'));

        if (!empty($employers)) {

            foreach ($employers as $employer) {
                if (!empty($employer) && $employer->employer_name !== null) {
                    if (!empty($employer->id)) {
                        $spouseEmployer = SpouseEmployer::updateOrCreate([
                            'id' => $employer->id,
                            'user_id' => $spouseInfo->user_id], 
                            [
                                'employer_name' => $employer->employer_name,
                                'employer_phone' => $employer->employer_phone,
                                'computer_username' => $employer->computer_username,
                                'computer_password' => $employer->computer_password
                            ]
                        );
                    } else {
                        $spouseEmployer = SpouseEmployer::create([
                            'user_id' => $spouseInfo->user_id,
                            'employer_name' => $employer->employer_name,
                            'employer_phone' => $employer->employer_phone,
                            'computer_username' => $employer->computer_username,
                            'computer_password' => $employer->computer_password
                        ]);
                    }

                    if (!empty($employer->address)) {
                        SpouseEmployerAddress::updateOrCreate([
                            'user_id' => $spouseInfo->user_id,
                            'employer_id' => $spouseEmployer->id
                        ], [
                            'street_address1' => $employer->address->street_address1,
                            'street_address2' => $employer->address->street_address2,
                            'city' => $employer->address->city,
                            'state' => $employer->address->state,
                            'zipcode' => $employer->address->zipcode,
                        ]);
                    }

                    // if (!empty($employer->benefits)) {
                    //     $benefitsSelected = $this->getSelectedBenefits($employer->benefits);
                    //     $spouseEmployer->benefits()->sync($benefitsSelected);
                    // }

                    if (!empty($employer->benefits)) {
                        $benefits = $employer->benefits;
                        SpouseEmployerBenefits::where('employer_id', $spouseEmployer->id)->delete();
                        foreach ($benefits as $benefit) {
                            $employerBenefits = new SpouseEmployerBenefits();
                            $employerBenefits->employer_id = $spouseEmployer->id;
                            $employerBenefits->benefit_id = $benefit->id;
                            $employerBenefits->save();
                        }
                    }

                }
            }
        }

        // Save step completed information
        $user = auth()->user();

        $user->steps()->syncWithoutDetaching([2 => [
            'user_id' => $user->id,
            'is_visited' => 1,
            'is_filled' => 1,
            'is_completed' => request('is_completed') ? 1 : 0
        ]]);

        //DB::commit();

        return response()
            ->json([
                'status' => 201,
                'message' => 'Spouse information has been updated successfully'
            ], 201);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param SpouseInfo $spouseInfo
     * @return JsonResponse
     */
    public function destroy(SpouseInfo $spouseInfo)
    {
        // Check if the Spouse Info is associated with Authenticated use
        // Delete Employers (Benefit and Addresses)
        // Delete Social Media
        // Delete Emails
        // Delete Personal Info
        if (auth()->id() == $spouseInfo->user_id) {
            try {
                $this->deleteEmployers($spouseInfo);
                $this->deleteSocialMedia($spouseInfo);
                $this->deleteEmails($spouseInfo);

                $spouseInfo->delete();

                return response()->json([
                    'status' => '201',
                    'message' => 'Spouse Information Deleted Successfully'
                ], '201');

            } catch (Exception $e) {
                return response()->json([
                    'status' => '500',
                    'message' => 'Something went wrong'
                ], '500');
            }
        } else {
            return response()->json([
                'status' => '401',
                'message' => 'Unauthorized'
            ], '401');
        }
    }

    /**
     * @param SpouseInfo $spouseInfo
     */
    protected function updateSpouseInformation(SpouseInfo $spouseInfo): void
    {
        $spouseInfo->marriage_date = Carbon::parse(request('marriage_date')) ?: "";
        $spouseInfo->marriage_location = request('marriage_location') ?: "";
        $spouseInfo->legal_name = request('legal_name') ?: "";
        $spouseInfo->nickname = request('nickname') ?: "";
        $spouseInfo->dob = Carbon::parse(request('dob')) ?: "";
        $spouseInfo->country_id = request('country_id') ?: null;
        $spouseInfo->passport_number = request('passport_number') ?: "";
        $spouseInfo->father_name = request('father_name') ?: "";
        $spouseInfo->father_birth_place = request('father_birth_place') ?: "";
        $spouseInfo->mother_name = request('mother_name') ?: "";
        $spouseInfo->mother_birth_place = request('mother_birth_place') ?: "";

        $spouseInfo->save();
    }

    private function deleteEmployers(SpouseInfo $spouseInfo)
    {
        $employers = SpouseEmployer::where('user_id', $spouseInfo->id)->get();

        foreach ($employers as $employer) {
            SpouseEmployerAddress::where('employer_id', $employer->id)->delete();

            // Delete Benefits
            $benefits = $employer->benefits;
            $map = $benefits->map(function ($items) {
                $data['id'] = $items->id;
                return $data;
            });

            $employer->benefits()->detach($map);
        }
        SpouseEmployer::where('user_id', $spouseInfo->id)->delete();
        return;
    }

    private function deleteSocialMedia(SpouseInfo $spouseInfo)
    {
        SpouseSocialMedia::where('user_id', $spouseInfo->id)->delete();
        return;
    }

    private function deleteEmails(SpouseInfo $spouseInfo)
    {
        SpouseEmail::where('user_id', $spouseInfo->id)->delete();
        return;
    }

    private function getSelectedBenefits($benefits)
    {
        $selectedBenefits = [];
        foreach ($benefits as $key => $value) {
            $selectedBenefits[$key] = $value->id;
        }

        return $selectedBenefits;
    }
}
