<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

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
//        return 'okay';
        return view('mushandirapamwe.home');
    }

    public function viewAllComplaints($category){

        return view('mushandirapamwe.view-complaints');



    }

    public function locationsOverview(){
        return view('reports.locations-overview');
    }

}

