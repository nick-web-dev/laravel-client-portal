<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ASNInventoryController extends Controller
{
    protected $rushmoreApiClient;

    public function __construct() {
        $this->rushmoreApiClient = resolve('App\Services\Rushmore');
    }

    public function index() {
        // $asn_data = json_decode($this->rushmoreApiClient->getASNData());
        // $asn_highlights = $asn_data->asn_highlights;        
        $asn = $this->rushmoreApiClient->getData('asns');
        $inventory = $this->rushmoreApiClient->getData('inventory');
        return view('asn-inventory.index', compact('asn', 'inventory'));
    }
}
