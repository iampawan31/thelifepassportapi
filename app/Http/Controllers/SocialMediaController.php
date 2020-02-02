<?php

namespace App\Http\Controllers;

use App\SocialMedia;
use Illuminate\Http\Request;

class SocialMediaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $socialMediaOptions = SocialMedia::select('id', 'title')->where('status', '1')->get();
        $map = $socialMediaOptions->map(function ($items) {
            $data['id'] = $items->id;
            $data['text'] = $items->title;
            return $data;
        });

        return response()->json(['social' => $map]);
    }
}
