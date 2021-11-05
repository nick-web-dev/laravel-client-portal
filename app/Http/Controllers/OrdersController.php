<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class OrdersController extends Controller
{
    protected $rushmoreApiClient;

    public function __construct() {
        $this->rushmoreApiClient = resolve('App\Services\Rushmore');
    }

    public function index() {
        $order_data = $this->rushmoreApiClient->getData('orders');

        // dd( $order_data );

        return view('orders.index', compact('order_data'));
    }
}
