<?php

namespace App\Http\Controllers;

use App\SpouseEstate;
use App\SpouseEstateAddress;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SpouseEstateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return JsonResponse
     */
    public function index()
    {
        $estateRepresentative = SpouseEstate::where('user_id', auth()->id())->first();
        return response()->json(['status' => 200, 'data' => $estateRepresentative], 200);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function store(Request $request)
    {
        try {
            DB::beginTransaction();

            // Insert Personal estate information
            $spouseEstate = $this->updateSpouseEstateInformation();

            // Insert Personal estate address.
            $address = json_decode(request('address'));

            if (!empty($address)) {
                $this->updateSpouseEstateAddress($spouseEstate, $address);
            }

            $this->updateStepInformation();

            DB::commit();

            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Spouse Estate information has been saved successfully'
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
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $count = \App\SpouseEstate::where('id', $id)->get()->count();

        if ($count > 0) {
            $spouseestate_info = \App\SpouseEstate::where('id', $id)
                ->with('Address')
                ->get();

            return response()->json(['status' => 200, 'data' => $spouseestate_info]);
        } else {
            return response()->json(['status' => 200, 'data' => [[]]]);
        }
    }

    /**
     * Update Spouse estate information.
     *
     * @param Request $request
     * @param $estateId
     * @return JsonResponse
     */
    public function update(Request $request, $estateId)
    {
        try {
            $spouseEstate = SpouseEstate::updateOrCreate(['id' => $estateId, 'user_id' => auth()->id()], [
                'legal_name' => request('legal_name'),
                'relationship' => request('relationship'),
                'company' => request('company'),
                'email' => request('email'),
                'phone' => request('phone'),
                'website' => request('website')
            ]);

            $address = json_decode(request('address'));

            if (!empty($address)) {
                $this->updateSpouseEstateAddress($spouseEstate, $address);
            }

            $this->updateStepInformation();

            return response()->json(['status' => 201, 'message' => 'Spouse Estate information has been updated successfully'], 201);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'message' => $e], 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user_id = Auth::user()->id;

        try {

            //remove family member phone
            \App\SpouseEstateAddress::where('spouse_estate_id', $id)->delete();

            //remove
            \App\SpouseEstate::where('id', $id)->delete();

            //get count of remaining members
            $count = \App\SpouseEstate::where('user_id', $user_id)->get()->count();

            if ($count == 0) {
                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                    ->where('user_id', $user_id)
                    ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            }

            return response()->json(['status' => 200, 'msg' => 'Spouse Estate information has removed successfully', 'estate_count' => $count], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error', 'estate_count' => 0], 500);
        }
    }

    public function updatespouseestatestatus(Request $request)
    {
        $inputs = $request->all();
        $user_id = Auth::user()->id;
        $has_spouseestate = $inputs['has_spouseestate'];

        try {
            $objSpouseestateStatus = \App\SpouseEstateStatus::where('user_id', $user_id)->get();

            if ($objSpouseestateStatus->count()) {
                \App\SpouseEstateStatus::where('user_id', $user_id)
                    ->update(['has_spouseestate' => $has_spouseestate]);
            } else {
                \App\SpouseEstateStatus::create(['user_id' => $user_id, 'has_spouseestate' => $has_spouseestate]);
            }

            if ($objSpouseestateStatus == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 8)
                ->where('user_id', $user_id)
                ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Spouse estate status has been updated successfully'], 200);

        } catch (Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function getspouseestatestatus()
    {

        $user_id = Auth::user()->id;

        try {
            //check for record
            $objSpouseEstateStatus = \App\SpouseEstateStatus::find($user_id);
            return response()->json(['status' => 200, 'data' => $objSpouseEstateStatus], 200);
        } catch (Exception $e) {
            return response()->json(['status' => 200, 'data' => [[]]], 200);
        }
    }

    public function updatestatus(Request $request)
    {
        $inputs = $request->all();
        $user_id = Auth::user()->id;
        $is_completed = @$inputs['chk_complete'] ? '1' : '0';

        //insert record in user spouse details completion
        $arrData = ['is_completed' => $is_completed];

        \App\UsersPersonalDetailsCompletion::where('step_id', 8)
            ->where('user_id', $user_id)
            ->update($arrData);

        return response()->json(['status' => 200, 'msg' => 'Spouse Estate information has completed successfully'], 200);
    }

    /**
     * @return mixed
     */
    protected function updateSpouseEstateInformation()
    {
        $spouseEstate = SpouseEstate::updateOrCreate(['user_id' => auth()->id()], [
            'legal_name' => request('legal_name'),
            'relationship' => request('relationship'),
            'company' => request('company'),
            'email' => request('email'),
            'phone' => request('phone'),
            'website' => request('website'),
        ]);
        return $spouseEstate;
    }

    /**
     * @param $spouseEstate
     * @param $address
     */
    protected function updateSpouseEstateAddress($spouseEstate, $address): void
    {
        $spouseEstateAddress = SpouseEstateAddress::updateOrCreate([
            'user_id' => auth()->id(),
            'spouse_estate_id' => $spouseEstate->id
        ], [
            'street_address1' => $address->street_address1,
            'street_address2' => $address->street_address2,
            'city' => $address->city,
            'state' => $address->state,
            'zipcode' => $address->zipcode,
        ]);
    }

    protected function updateStepInformation(): void
    {
        auth()->user()->steps()->syncWithoutDetaching([8 => [
            'is_visited' => 1,
            'is_filled' => 1,
            'is_completed' => request('is_completed') ? 1 : 0
        ]]);
    }
}
