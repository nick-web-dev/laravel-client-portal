<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ReturnsController extends Controller
{
    protected $rushmoreApiClient;

    public function __construct() {
        $this->rushmoreApiClient = resolve('App\Services\Rushmore');
    }

    public function index() {
        $return_data = $this->rushmoreApiClient->getData('returns');
        return view('returns.index', compact('return_data'));
    }
}
