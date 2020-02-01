<?php

namespace App\Http\Controllers\Api;

use App\Country;
use App\Http\Resources\Country as CountryResource;
use App\Http\Controllers\Controller;

class CountryController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('verified');
    }

    /**
     * Display the Personal Information Page.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $countries = Country::select('id', 'country_name')->get();
        $map = $countries->map(function ($items) {
            $data['id'] = $items->id;
            $data['text'] = $items->country_name;
            return $data;
        });

        return response()->json(['countries' => $map]);
    }
}
