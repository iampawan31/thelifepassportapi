<?php

namespace App\Http\Controllers;

use Illuminate\Contracts\View\Factory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class DashboardController extends Controller
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
     * Handle the incoming request.
     *
     * @param Request $request
     * @return Factory|View
     */
    public function index(Request $request)
    {
        return view('dashboard.index')
            ->with('page_title', 'Dashboard');
    }
}
