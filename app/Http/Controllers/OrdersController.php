<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;

class OrdersController
{
    public function index(Rushmore $api)
    {
        return view('orders.index', ['orders' => $api->getData('orders')]);
    }
}
