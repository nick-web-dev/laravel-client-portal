<?php

namespace App\Http\Controllers;

//use App\Services\Rushmore;
use App\Services\Owd;

class ASNInventoryController
{
    public function index(Owd $api)
    {
        $data = $api->getData('asns-inventory');

        return view('asn-inventory.index', [
            'asn'       => $data->asn,
            'inventory' => $data->inventory,
        ]);
    }
}
