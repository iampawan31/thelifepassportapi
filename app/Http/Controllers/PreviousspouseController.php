<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Exception;
use Session, Auth;
use App\PreviousSpouseInfo;
use App\PreviousSpousePhone;
use Illuminate\Http\Request;
use App\PreviousSpouseAddress;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;

class PreviousspouseController extends Controller
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
        $user_id = Auth::user()->id;
        $count = \App\PreviousSpouseInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = PreviousSpouseInfo::where('user_id', auth()->id())->first();
            // $previous_spouse_info = \App\PreviousSpouseInfo::where('user_id', $user_id)
            //     ->with('Address')
            //     ->with('PreviousSpousePhone')
            //     ->with('DivorceDoc')
            //     ->with('UsersPersonalDetailsCompletion')
            //     ->get();
            
            return response()->json(
                [
                    'status' => 200, 
                    'data' => $previous_spouse_info,
                    'is_completed' => auth()->user()->stepCompleted(3)
                ]
            );
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
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
        try {
            DB::beginTransaction();

            $inputs = $request->all();
            
            $user = User::find(auth()->id());

            // Save previous spouse information
            $previousSpouseInfo = new PreviousSpouseInfo;

            $previousSpouseInfo->user_id = $user->id;
            $this->updatePerviousSpouseInformation($previousSpouseInfo);

            // Save user's personal address
            $address = json_decode(request('previousspouse_address'));

            if (!empty($address)) {
                $prevSpouseAddress = new PreviousSpouseAddress;

                $prevSpouseAddress->user_id         = $user->id;
                $prevSpouseAddress->street_address1 = $address->street_address1 ?: "";
                $prevSpouseAddress->street_address2 = $address->street_address2 ?: "";
                $prevSpouseAddress->city            = $address->city ?: "";
                $prevSpouseAddress->state           = $address->state ?: "";
                $prevSpouseAddress->zipcode         = $address->zipcode ?: "";

                $prevSpouseAddress->save();
            }

            //Saving user's phone numbers
            $phoneNumbers = json_decode(request('previousspouse_phones'));
            
            if (!empty($phoneNumbers)) {
                foreach ($phoneNumbers as $phone) {
                    if ($phone) {
                        PreviousSpousePhone::create(['user_id' => $user->id, 'phone' => $phone->phone]);
                    }
                }
            }
            
            //upload divorce documents
            if ($request->file('alimony_agreement')) {
                $file       = $request->file('alimony_agreement');
                $ext        = $file->getClientOriginalExtension();
                $filename   = $path = hash( 'sha256', time()) . '.' . $ext;
                $path       = 'divorce_agreement/';
                
                if(Storage::disk('public')->put($path.$filename, File::get($file))) {
                    $documents = [
                        'user_id'   => $user->id,
                        'title'     => $filename,
                        'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                    ];
                    
                    $objPhone = \App\DivorceDoc::create($documents);
                }
            }

            if ($request->file('child_support_agreement')) {
                $file       = $request->file('child_support_agreement');
                $ext        = $file->getClientOriginalExtension();
                $filename   = $path = hash( 'sha256', time()) . '.' . $ext;
                $path       = 'divorce_agreement/';
                
                if(Storage::disk('public')->put($path.$filename, File::get($file))) {
                    $documents = [
                        'user_id'   => $user->id,
                        'title'     => $filename,
                        'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                    ];
                    
                    $objPhone = \App\ChildSupportDoc::create($documents);
                }
            }

            $user->steps()->syncWithoutDetaching([3 => [
                'user_id' => $user->id,
                'is_visited' => 1,
                'is_filled' => 1,
                'is_completed' => request('is_completed') ? 1 : 0
            ]]);

            DB::commit();
            return response()
                ->json([
                    'status' => 201,
                    'message' => 'Previous Spouse information has been saved successfully'
                ], 201);
        } catch(Exception $e) {
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
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $count = \App\PreviousSpouseInfo::where('user_id', $id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = \App\PreviousSpouseInfo::find($id)
                ->with('PreviousSpousePhone')
                ->get();
            
            return response()->json(['status' => 200, 'data' => $previous_spouse_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (auth()->id()) {
            try {
                $user = auth()->user();

                DB::beginTransaction();

                // Save previous spouse information
                $previousSpouseInfo = PreviousSpouseInfo::find($user->id);
               
                $this->updatePerviousSpouseInformation($previousSpouseInfo);

                // Save user's personal address
                $address = json_decode(request('previousspouse_address'));

                if (!empty($address)) {
                    $prevSpouseAddress = PreviousSpouseAddress::updateOrCreate([
                        'user_id' => $user->id,
                    ],[
                        'street_address1' => $address->street_address1 ?: "",
                        'street_address2' => $address->street_address2 ?: "",
                        'city'            => $address->city ?: "",
                        'state'           => $address->state ?: "",
                        'zipcode'         => $address->zipcode ?: ""
                    ]);
                }

                //Saving user's phone numbers
                $phoneNumbers = json_decode(request('previousspouse_phones'));
                
                if (!empty($phoneNumbers)) {
                    PreviousSpousePhone::where('user_id', $user->id)->delete();
                    foreach ($phoneNumbers as $phone) {
                        if ($phone) {
                            PreviousSpousePhone::create(['user_id' => $user->id, 'phone' => $phone->phone]);
                        }
                    }
                }
                
                //upload divorce documents
                if ($request->file('alimony_agreement')) {
                    $file       = $request->file('alimony_agreement');
                    $ext        = $file->getClientOriginalExtension();
                    $filename   = $path = hash( 'sha256', time()) . '.' . $ext;
                    $path       = 'divorce_agreement/';
                    
                    if(Storage::disk('public')->put($path.$filename, File::get($file))) {
                        $documents = [
                            'user_id'   => $user->id,
                            'title'     => $filename,
                            'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                        ];
                        \App\DivorceDoc::where('user_id', $user->id)->delete();
                        \App\DivorceDoc::create($documents);
                    }
                }

                if ($request->file('child_support_agreement')) {
                    $file       = $request->file('child_support_agreement');
                    $ext        = $file->getClientOriginalExtension();
                    $filename   = $path = hash( 'sha256', time()) . '.' . $ext;
                    $path       = 'divorce_agreement/';
                    
                    if(Storage::disk('public')->put($path.$filename, File::get($file))) {
                        $documents = [
                            'user_id'   => $user->id,
                            'title'     => $filename,
                            'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                        ];
                        
                        \App\ChildSupportDoc::where('user_id', $user->id)->delete();
                        \App\ChildSupportDoc::create($documents);
                    }
                }

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
                        'message' => 'Previous Spouse information has been saved successfully'
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

        return response()
            ->json([
                'status' => 500,
                'message' => "Something went wrong. Error Code APIC#332"
            ], 500);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            \DB::transaction(function () {
                
                //remove sopuse information
                \App\PreviousSpouseInfo::where('user_id', Auth::user()->id)->delete();

                //remove sopuse address
                \App\PreviousSpouseAddress::where('user_id', Auth::user()->id)->delete();
    
                //remove spouse phone
                \App\PreviousSpousePhone::where('user_id', Auth::user()->id)->delete();

                //remove marriage status
                \App\PreviousMarriageStatus::where('user_id', Auth::user()->id)->delete();

                $objDivorceFile = \App\DivorceDoc::where('user_id', Auth::user()->id)->get();

                $objChildSupportFile = \App\ChildSupportDoc::where('user_id', $user->id)->get();

                if ($objDivorceFile->count()) {
                    //remove previous divorce documents
                    File::delete($objDivorceFile[0]->url);
                    
                    \App\DivorceDoc::where('user_id', Auth::user()->id)->delete();
                }

                if ($objChildSupportFile->count()) {
                    //remove previous divorce documents
                    File::delete($objChildSupportFile[0]->url);
                    
                    \App\ChildSupportDoc::where('user_id', Auth::user()->id)->delete();
                }

                //update step table
                \App\UsersPersonalDetailsCompletion::where('step_id', 3)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '0', 'is_completed' => '0']);
            });

            return response()->json(['status' => 200, 'msg' => 'Previous Spouse information has removed successfully'], 200);
        } catch(Exception $e) {
            dd($e);
            return response()->json(['status' => 200, 'msg' => 'Error'], 500);
        }
    }

    public function getpreviousspouseinfo() {
        //DB::enableQueryLog();
        $user_id = Auth::user()->id;
        $count = \App\PreviousSpouseInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = \App\PreviousSpouseInfo::where('user_id', $user_id)
                ->with('address')
                ->with('phones')
                ->with('documents')
                ->with('childsupportdoc')
                ->with('step')
                ->get();
            //dd(DB::getQueryLog());
            return response()->json(['status' => 200, 'data' => $previous_spouse_info]);
        } else {
            return response()->json(['status' => 200, 'data' => []]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updatemarriagestatus(Request $request) {
        $inputs = $request->all();
        
        $user_id    = Auth::user()->id;
        $is_married = $inputs['is_married'];

        try {
            //check for record
            $objMarriageStatus = \App\PreviousMarriageStatus::find($user_id);
            if ($objMarriageStatus) {
                \App\PreviousMarriageStatus::where('user_id', $user_id)
                                    ->update(['is_previously_married' => $is_married]);
            } else {
                \App\PreviousMarriageStatus::create(['user_id' => $user_id, 'is_previously_married' => $is_married]);
            }

            //insert record in user personal details completion
            if ($is_married == "0") {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '1'];
            } else {
                $arrData = ['is_visited' => '1', 'is_filled' => '1', 'is_completed' => '0'];
            }

            \App\UsersPersonalDetailsCompletion::where('step_id', 3)
                                                 ->where('user_id', $user_id)
                                                 ->update($arrData);

            return response()->json(['status' => 200, 'msg' => 'Marriage status has been updated successfully']);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'msg' => 'Error']);
        }
    }

    public function getpreviousmarriagestatus() {
        
        $user_id    = Auth::user()->id;

        try {
            //check for record
            $objMarriageStatus = \App\PreviousMarriageStatus::find($user_id);
            
            return response()->json(['status' => 200, 'data' => $objMarriageStatus]);
        } catch (Exception $e) {
            return response()->json(['status' => 503, 'data' => [[]]]);
        }
    }

    public function removedivorcefile() {

        $user_id = Auth::user()->id;

        try {
            //DB::enableQueryLog();
            #get file information
            $objDivorceFile = \App\DivorceDoc::where('user_id', $user_id)->first();
            //dd(DB::getQueryLog());

            if ($objDivorceFile->count()) {
                //remove previous divorce documents
                File::delete($objDivorceFile->url);
                //Storage::delete($objDivorceFile->url);
                
                \App\DivorceDoc::where('user_id', $user_id)->delete();
            }

            return response()->json(['status' => 200, 'msg' => 'Files has deleted successfully'], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function removechildsupportfile() {

        $user_id = Auth::user()->id;

        try {
            //DB::enableQueryLog();
            #get file information
            $objChildSupportFile = \App\ChildSupportDoc::where('user_id', $user_id)->first();
            //dd(DB::getQueryLog());

            if ($objChildSupportFile->count()) {
                //remove previous divorce documents
                File::delete($objChildSupportFile->url);
                
                \App\ChildSupportDoc::where('user_id', $user_id)->delete();
            }

            return response()->json(['status' => 200, 'msg' => 'Files has deleted successfully'], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 500, 'msg' => 'Error'], 500);
        }
    }

    public function updatePerviousSpouseInformation(PreviousSpouseInfo $perviousSpouseInfo): void 
    {
        $perviousSpouseInfo->legal_name             = request('legal_name') ?: "";
        $perviousSpouseInfo->marriage_date          = request('date') ? date('Y-m-d', strtotime(request('date'))) : null;
        $perviousSpouseInfo->marriage_location      = request('marriage_location') ?: "";
        $perviousSpouseInfo->divorce_date           = request('divorce_date') ? date('Y-m-d', strtotime(request('divorce_date'))) : null;
        $perviousSpouseInfo->divorce_location       = request('divorce_location') ?: "";
        $perviousSpouseInfo->email                  = request('email') ?: "";
        $perviousSpouseInfo->is_alimony_paid        = request('owe_alimony') ? '1' : '0';
        $perviousSpouseInfo->divorce_agreement_doc  = request('divorce_agreement_doc') ?: "";
        $perviousSpouseInfo->alimony_amount         = request('alimony_amount') ?: 0;
        $perviousSpouseInfo->is_child_support       = request('owe_child_support') ? '1' : "0";
        $perviousSpouseInfo->child_support_amount   = request('child_support_amount') ?: 0;

        $perviousSpouseInfo->save();
    }
}
