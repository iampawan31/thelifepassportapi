<?php

namespace App\Http\Controllers;

use DB;
use App\User;
use Exception;
use Session, Auth;
use Illuminate\Http\Request;
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
        //
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
        $inputs = $request->all();
        
        //previous spouse information
        $user_id                = Auth::user()->id;
        $legal_name             = $inputs['legal_name'];
        $marriage_date          = $inputs['marriage_date'];
        $marriage_location      = $inputs['marriage_location'];
        $divorce_date           = $inputs['divorce_date'];
        $divorce_location       = $inputs['divorce_location'];
        $email                  = $inputs['email'];
        $address                = $inputs['address'];
        $is_alimony_paid        = @$inputs['owe_alimony'];
        $divorce_agreement_doc  = "";
        $alimony_amount         = @$inputs['alimony_amount'];
        $is_completed           = @$inputs['chk_complete'];

        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => $user_id, 'phone' => $phone];
                }
            }
        }

        $arrPreviousSpouseInfo = [
            'user_id'           => $user_id,
            'legal_name'        => $legal_name ? $legal_name : "",
            'marriage_date'     => $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : null,
            'marriage_location' => $marriage_location ? $marriage_location : "",
            'divorce_date'      => $divorce_date ? date('Y-m-d', strtotime($divorce_date)) : null,
            'divorce_location'  => $divorce_location ? $divorce_location : "",
            'address'           => $address ? $address : "",
            'email'             => $email ? $email : "",
            'is_alimony_paid'   => $is_alimony_paid == true ? '1' : '0',
            'divorce_agreement_doc'  => "",
            'alimony_amount'    => $alimony_amount ? $alimony_amount : 0
        ];

        try {
            //insert Previous Spouce information
            $objPreviousSpouseInfo = \App\PreviousSpouseInfo::create($arrPreviousSpouseInfo);

            // //insert record in user personal details completion
            $is_completed = $is_completed ? '1' : '0';
            \App\UsersPersonalDetailsCompletion::where('step_id', 3)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1', 'is_completed' => $is_completed]);

            //insert previous spouse phone information
            if (!empty($arrPhone)) {
                foreach($arrPhone as $phones){
                    $objPhone = \App\PreviousSpousePhone::create($phones);
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
                        'user_id'   => $user_id,
                        'title'     => $filename,
                        'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                    ];
                    
                    $objPhone = \App\DivorceDoc::create($documents);
                }
            }
            
            return response()->json(['status' => 200, 'message' => 'Previous Spouse information has been saved successfully'], 200);
        } catch(Exception $e) {
            dd($e);
            return response()->json(['status' => 500, 'message' => 'Error'], 500);
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
        $inputs = $request->all();
       
        //personal information
        $user_id            = Auth::user()->id;
        $legal_name         = $inputs['legal_name'];
        $marriage_date      = $inputs['marriage_date'];
        $marriage_location  = $inputs['marriage_location'];
        $divorce_date       = $inputs['divorce_date'];
        $divorce_location   = $inputs['divorce_location'];
        $email              = $inputs['email'];
        $address                = $inputs['address'];
        $is_alimony_paid        = @$inputs['owe_alimony'];
        $divorce_agreement_doc  = "";
        $alimony_amount         = @$inputs['alimony_amount'];
        $is_completed       = @$inputs['chk_complete'];
       
        //phone info
        $arrPhone = [];
        if (isset($inputs['phone'])) {
            foreach($inputs['phone'] as $phone) {
                if ($phone) {
                    $arrPhone[] = ['user_id' => $user_id, 'phone' => $phone];
                }
            }
        }

        try {
            //get previous spouse information
            $objPreviousSpouseInfo                      = \App\PreviousSpouseInfo::find($id);
            $objPreviousSpouseInfo->legal_name          = $legal_name ? $legal_name : "";
            $objPreviousSpouseInfo->marriage_date       = $marriage_date ? date('Y-m-d', strtotime($marriage_date)) : null;
            $objPreviousSpouseInfo->marriage_location   = $marriage_location ? $marriage_location : "";
            $objPreviousSpouseInfo->divorce_date        = $divorce_date ? date('Y-m-d', strtotime($divorce_date)) : null;
            $objPreviousSpouseInfo->divorce_location    = $divorce_location ? $divorce_location : "";
            $objPreviousSpouseInfo->address             = $address ? $address : "";
            $objPreviousSpouseInfo->email               = $email ? $email : "";
            $objPreviousSpouseInfo->is_alimony_paid     = $is_alimony_paid == true ? '1' : '0';
            $objPreviousSpouseInfo->divorce_agreement_doc = "";
            $objPreviousSpouseInfo->alimony_amount      = $alimony_amount ? $alimony_amount : 0;
            $objPreviousSpouseInfo->save();

            // //insert record in user personal details completion
            $is_completed = $is_completed ? '1' : '0';
            \App\UsersPersonalDetailsCompletion::where('step_id', 3)
                                                ->where('user_id', Auth::user()->id)
                                                ->update(['is_visited' => '1', 'is_filled' => '1', 'is_completed' => $is_completed]);

            //insert previous spouse phone information
            if (!empty($arrPhone)) {
                //remove all phone details
                \App\PreviousSpousePhone::where('user_id', $user_id)->delete();
                foreach($arrPhone as $phones){
                    $objPhone = \App\PreviousSpousePhone::create($phones);
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
                        'user_id'   => $user_id,
                        'title'     => $filename,
                        'url'       => App::make('url')->to('/storage/divorce_agreement/'.$filename)
                    ];
                    
                    //remove previous divorce documents
                    \App\DivorceDoc::where('user_id', $user_id)->delete();
                    $objPhone = \App\DivorceDoc::create($documents);
                }
            }
            
            return response()->json(['status' => 200, 'message' => 'Previous Spouse information has been saved successfully'], 200);
        } catch(Exception $e) {
            return response()->json(['status' => 503, 'message' => 'Error'], 503);
        }
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
    
                //remove spouse phone
                \App\PreviousSpousePhone::where('user_id', Auth::user()->id)->delete();

                //remove marriage status
                \App\PreviousMarriageStatus::where('user_id', Auth::user()->id)->delete();

                $objDivorceFile = \App\DivorceDoc::where('user_id', Auth::user()->id)->get();
                
                if ($objDivorceFile->count()) {
                    //remove previous divorce documents
                    File::delete($objDivorceFile[0]->url);
                    
                    \App\DivorceDoc::where('user_id', Auth::user()->id)->delete();
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
        $user_id = Auth::user()->id;
        $count = \App\PreviousSpouseInfo::where('user_id', $user_id)->get()->count();
        if ($count > 0) {
            $previous_spouse_info = \App\PreviousSpouseInfo::where('user_id', $user_id)
                ->with('PreviousSpousePhone')
                ->with('DivorceDoc')
                ->with('UsersPersonalDetailsCompletion')
                ->get();
            
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
            $objDivorceFile = \App\DivorceDoc::find($user_id)->first();
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
}
