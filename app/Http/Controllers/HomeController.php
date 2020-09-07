<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Fundraiser;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $paybill = config('mpesaconfigs.ShortCode');
        $userid = Auth::user()->id;
        $fundraisers = DB::table('fundraisers')->where('userID', '=', $userid)->get();
        return view('home', compact('fundraisers','paybill'));
    }
}
