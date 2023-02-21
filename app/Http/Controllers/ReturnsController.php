<?php

namespace App\Http\Controllers;

//use App\Services\Rushmore;
use App\Services\Owd;

class ReturnsController
{
    public function index(Owd $api)
    {
        //dd($api->getData('returns'));
        return view('returns.index', ['returns' => $api->getData('returns')]);
    }
}
