<?php

namespace App\Http\Controllers;

use App\PersonalEstate;
use App\PersonalEstateAddress;
use App\User;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Session, Auth;
use Illuminate\Http\Request;

class PersonalEstateController extends Controller
{
    /**
     * Get personal estate information.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $estateRepresentative = PersonalEstate::where('user_id', auth()->id())->first();
        return response()->json(['status' => 200, 'data' => $estateRepresentative], 200);
    }

    /**
     * Store personal estate information.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insert Personal estate information
            $personalEstate = $this->updateEstateInformation();

            // Insert Personal estate address.
            $address = json_decode(request('address'));

            if (!empty($address)) {
                $this->updateEstateAddress($personalEstate, $address);
            }

            $this->updateStepInformation();

            DB::commit();

            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Personal Estate information has been saved successfully'
                ], 201);
        } catch (Exception $e) {
            DB::rollBack();
            return response()->json(['status' => 500, 'message' => $e], 500);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return Response
     */
    public function edit($id)
    {
        $count = \App\PersonalEstate::where('id', $id)->get()->count();

        if ($count > 0) {
            $personalestate_info = \App\PersonalEstate::where('id', $id)
                ->with('Address')
                ->get();

            return response()->json(['status' => 200, 'data' => $personalestate_info]);
        } else {
            return response()->json(['status' => 200, 'data' => [[]]]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param $estateId
     * @return JsonResponse
     */
    public function update(Request $request, $estateId)
    {
        try {
            $personalEstate = PersonalEstate::updateOrCreate(['id' => $estateId, 'user_id' => auth()->id()], [
                'legal_name' => request('legal_name'),
                'relationship' => request('relationship'),
                'company' => request('company'),
                'email' => request('email'),
                'phone' => request('phone'),
                'website' => request('website')
            ]);

            $address = json_decode(request('address'));

            if (!empty($address)) {
                $this->updateEstateAddress($personalEstate, $address);
            }

            $this->updateStepInformation();

            return response()->json(['status' => 201, 'message' => 'Personal Estate information has been updated successfully'], 201);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;

        try {

            //remove family member phone
            \App\PersonalEstateAddress::where('estate_id', $id)->delete();

            //remove
            \App\PersonalEstate::where('id', $id)->delete();

            //get count of remaining members
            $count = \App\PersonalEstate::where('user_id', $user_id)->get()->count();

            if ($count == 0) {
                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                    ->where('user_id', $user_id)
                    ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            }

            return response()->json(['status' => 200, 'msg' => 'Personal Estate information has removed successfully', 'estate_count' => $count], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error', 'estate_count' => 0], 500);
        }
    }

    public function updatepersonalestatestatus(Request $request)
    {
        // Called on question page.
        $inputs = $request->all();
        $user_id = Auth::user()->id;
        $has_personalestate = $inputs['has_personalestate'];

        try {
            $objPersonalestateStatus = \App\PersonalEstateStatus::where('user_id', $user_id)->get();

            if ($objPersonalestateStatus->count()) {
                \App\PersonalEstateStatus::where('user_id', $user_id)
                    ->update(['has_personalestate' => $has_personalestate]);
            } else {
                \App\PersonalEstateStatus::create(['user_id' => $user_id, 'has_personalestate' => $has_personalestate]);
            }

            if ($objPersonalestateStatus == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 7)
                ->where('user_id', $user_id)
                ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Personal estate status has been updated successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function getpersonalestatestatus()
    {

        $user_id = Auth::user()->id;

        try {
            //check for record
            $objPersonalEstateStatus = \App\PersonalEstateStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objPersonalEstateStatus], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 200, 'data' => [[]]], 200);
        }
    }

    public function updatestatus(Request $request)
    {
        $inputs = $request->all();
        $user_id = Auth::user()->id;
        $is_completed = @$inputs['chk_complete'] ? '1' : '0';

        //insert record in user personal details completion
        $arrData = ['is_completed' => $is_completed];

        \App\UsersPersonalDetailsCompletion::where('step_id', 7)
            ->where('user_id', $user_id)
            ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Personal Estate information has completed successfully'], 200);
    }

    /**
     * @return mixed
     */
    protected function updateEstateInformation()
    {
        $personalEstate = PersonalEstate::updateOrCreate(['user_id' => auth()->id()], [
            'legal_name' => request('legal_name'),
            'relationship' => request('relationship'),
            'company' => request('company'),
            'email' => request('email'),
            'phone' => request('phone'),
            'website' => request('website'),
        ]);
        return $personalEstate;
    }

    /**
     * @param $personalEstate
     * @param $address
     */
    protected function updateEstateAddress($personalEstate, $address): void
    {
        $personalEstateAddress = PersonalEstateAddress::updateOrCreate([
            'estate_id' => $personalEstate->id,
            'user_id' => auth()->id()], [
            'street_address1' => $address->street_address1,
            'street_address2' => $address->street_address2,
            'city' => $address->city,
            'state' => $address->state,
            'zipcode' => $address->zipcode
        ]);
    }

    protected function updateStepInformation(): void
    {
        auth()->user()->steps()->syncWithoutDetaching([7 => [
            'is_visited' => 1,
            'is_filled' => 1,
            'is_completed' => request('is_completed') ? 1 : 0
        ]]);
    }
}
