<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;

class HomeController
{

    public function dashboard(Rushmore $api)
    {
        $live_data = $api->getData('dashboard');
        $fulfillment = $live_data->fulfillment;

        return view('dashboard', compact('fulfillment', 'live_data'));
    }
}
