<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;

class OrdersController
{
    public function index(Rushmore $api)
    {
        $orders = $api->getData('orders');

        return view('orders.index', compact('orders'));
    }
}
