<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;

class ReturnsController
{
    public function index(Rushmore $api)
    {
        return view('returns.index', ['returns' => $api->getData('returns')]);
    }
}
