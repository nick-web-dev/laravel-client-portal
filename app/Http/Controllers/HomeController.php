<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller {

    public function index() {
        return view('home');
    }

    public function dashboard(Request $request) {
        $live_data = $this->rushmoreApiClient->getData('dashboard');
        // dd( $live_data );
        $fulfillment = $live_data->fulfillment;


        return view('dashboard', compact('fulfillment', 'live_data'));
    }

    public function fulfillmentData() {
        $fulfillment_data = json_decode($this->rushmoreApiClient->getFulfillmentData());
        $fulfillment = $fulfillment_data->fulfillment;

        return $fulfillment;
    }

    public function orderData() {
        $order_data = json_decode($this->rushmoreApiClient->getOrderData());
        return $order_data;
    }
}
