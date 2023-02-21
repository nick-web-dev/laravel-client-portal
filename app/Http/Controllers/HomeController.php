<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;
use App\Services\Owd;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function __construct()
    {
        //$this->middleware('auth');
    }
    public function dashboard(Owd $api)
    {
        $live_data = $api->getData('dashboard');
        //$fulfillment = $live_data->fulfillment;
        //dd($live_data);
        return view('dashboard', compact('live_data'));
    }
}
