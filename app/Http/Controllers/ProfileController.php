<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Services\Rushmore;

class ProfileController extends Controller {
    protected $rushmoreApiClient;

    public function __construct(Rushmore $rushmoreApiClient) {
        $this->rushmoreApiClient = $rushmoreApiClient;
    }

    public function index() {
        $user_data = $this->userData();
        return view('profile', compact('user_data'));
    }

    public function userData() {
        $user = $this->rushmoreApiClient->getUserData();
        return $user;
    }
}