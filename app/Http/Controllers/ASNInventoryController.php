<?php

namespace App\Http\Controllers;

use App\Services\Rushmore;

class ASNInventoryController
{
    public function index(Rushmore $api)
    {
        $data = $api->getData('asns-inventory');

        return view('asn-inventory.index', [
            'asn'       => $data->asn,
            'inventory' => $data->inventory,
        ]);
    }
}
