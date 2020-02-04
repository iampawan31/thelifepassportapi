<?php

namespace App\Http\Controllers;

use App\FamilyMemberAddress;
use App\FamilyMembers;
use App\FamilyPhone;
use App\FamilyRelation;
use App\FamilyStatus;
use Auth;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class FamilyController extends Controller
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
     * Return all family members related to authenticated user.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $familyMembers = FamilyMembers::where('user_id', auth()->id())->get();
        return response()->json(['status' => 200, 'data' => $familyMembers], 200);
    }

    /**
     * Return information for adding a family member..
     *
     * @return JsonResponse
     */
    public function create()
    {
        $familyRelations = FamilyRelation::where('status', 1)->get();

        $map = $familyRelations->map(function ($items) {
            $data['id'] = $items->id;
            $data['text'] = $items->title;
            return $data;
        });
        return response()->json(['data' => $map], 200);
    }

    /**
     * Store Family Member Information.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        // Insert Family Member Information
        // Update family member count
        // Insert family member address
        // Insert family member phone number(s)
        try {
            DB::beginTransaction();

            $familyMember = new FamilyMembers;

            $familyMember->user_id = auth()->id();
            $this->updateFamilyMemberInformation($familyMember);

            FamilyStatus::where('user_id', auth()->id())->increment('count');
            FamilyStatus::where('user_id', auth()->id())->update(['has_family_member' => true]);

            $address = json_decode(request('address'));
            if (!empty($address)) {
                $familyMemberAddress = new FamilyMemberAddress;

                $familyMemberAddress->user_id = auth()->id();
                $familyMemberAddress->family_member_id = $familyMember->id;
                $familyMemberAddress->street_address1 = $address->street_address1;
                $familyMemberAddress->street_address2 = $address->street_address2;
                $familyMemberAddress->city = $address->city;
                $familyMemberAddress->state = $address->state;
                $familyMemberAddress->zipcode = $address->zipcode;

                $familyMemberAddress->save();

            }

            $this->updateFamilyMemberPhoneNumbers($familyMember);

            DB::commit();
            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Family members information has been saved successfully'
                ], 201);

        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $e]);
        }

    }

    /**
     * Return information for updating a family member information.
     *
     * @param $familyMemberId
     * @return JsonResponse
     */
    public function edit($familyMemberId)
    {
        $familyMember = FamilyMembers::where('id', $familyMemberId)->first();
        if (!empty($familyMember)) {
            return response()->json(['data' => $familyMember], 200);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param $familyMemberId
     * @return JsonResponse
     */
    public function update($familyMemberId)
    {
        // Check if the family member exists for an authenticated user.
        // Update family member information.
        // Update family member address.
        // Update family member phone number(s).

        $familyMember = FamilyMembers::where(['id' => $familyMemberId, 'user_id' => auth()->id()])->first();

        if ($familyMember) {

            try {
                DB::beginTransaction();

                $this->updateFamilyMemberInformation($familyMember);

                $address = json_decode(request('address'));
                if (!empty($address)) {
                    FamilyMemberAddress::updateOrCreate([
                        'user_id' => auth()->id(),
                        'family_member_id' => $familyMember->id
                    ], [
                        'street_address1' => $address->street_address1,
                        'street_address2' => $address->street_address2,
                        'city' => $address->city,
                        'state' => $address->state,
                        'zipcode' => $address->zipcode
                    ]);
                }

                $this->updateFamilyMemberPhoneNumbers($familyMember);

                DB::commit();

                return response()
                    ->json([
                        'status' => 201,
                        'message' => 'Family member information updated successfully'
                    ], 201);
            } catch (Exception $exception) {
                DB::rollBack();
                return response()->json(['status' => 500, 'message' => $exception], 500);
            }
        } else {
            return response()->json(['status' => 401, 'message' => 'This action is unauthorized'], 401);
        }
    }

    /**
     * Remove family member for an authenticated user.
     *
     * @param $familyMemberId
     * @return JsonResponse
     */
    public function destroy($familyMemberId)
    {
        // Check if the Family member is related to User
        // Delete Family Member Address
        // Delete Family Member Phone Number(s)
        // Delete Family Member
        // Update Family Member Count

        $familyMember = FamilyMembers::where(['id' => $familyMemberId, 'user_id' => auth()->id()])->first();

        if ($familyMember->user_id == auth()->id()) {
            try {
                FamilyMemberAddress::where('family_member_id', $familyMember->id)->delete();
                FamilyPhone::where('family_member_id', $familyMember->id)->delete();
                FamilyMembers::where('id', $familyMember->id)->delete();

                FamilyStatus::where('user_id', auth()->id())->decrement('count');


                if (FamilyMembers::where('user_id', auth()->id())->get()->count() == 0) {
                    FamilyStatus::where('user_id', auth()->id())->update(['has_family_member' => false]);
                    auth()->user()->steps()->syncWithoutDetaching(4, [
                        'is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0'
                    ]);
                }

                return response()->json(['status' => 201, 'message' => 'Family Member removed successfully'], 201);

            } catch (Exception $exception) {
                return response()->json(['status' => 500, 'message' => $exception], 500);
            }
        } else {
            return response()->json(['status' => 401, 'message' => 'Unauthorized action'], 401);
        }
    }

    /**
     * @param $familyMember
     */
    protected function updateFamilyMemberInformation($familyMember): void
    {
        $familyMember->legal_name = request('legal_name');
        $familyMember->relationship_id = request('relationship_id');
        $familyMember->relationship_other = request('relationship_other');
        $familyMember->dob = Carbon::parse(request('dob'));
        $familyMember->email = request('email');

        $familyMember->save();
    }

    /**
     * @param $familyMember
     * @return mixed
     */
    protected function updateFamilyMemberPhoneNumbers($familyMember)
    {
        $phoneNumbers = json_decode(request('phones'));

        if (!empty($phoneNumbers)) {
            FamilyPhone::where([
                'user_id' => auth()->id(),
                'family_member_id' => $familyMember->id
            ])->delete();

            foreach ($phoneNumbers as $phone) {
                if (!empty($phone) && $phone->phone !== null) {
                    FamilyPhone::create([
                        'user_id' => auth()->id(),
                        'family_member_id' => $familyMember->id,
                        'phone' => $phone->phone
                    ]);
                }
            }
        }
        return;
    }
}
