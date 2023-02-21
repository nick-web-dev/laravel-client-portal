<?php

namespace App\Http\Controllers;

//use App\Services\Rushmore;
use App\Services\Owd;

class OrdersController
{
    public function index(Owd $api)
    {
        //dd($api->getData('orders'));
        return view('orders.index', ['orders' => $api->getData('orders')]);
    }
}
