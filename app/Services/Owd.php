<?php

namespace App\Services;

use App\Dto\Owd\AsnInventoryDashboard;
use App\Dto\Owd\Dashboard;
use App\Dto\Owd\ReturnsDashboard;
use App\Dto\Owd\SalesOrderDashboard;
use Illuminate\Support\Facades\Http;

class Owd{
    protected $api;
    protected $client_id;

    public $faker;

    public function __construct($apiUrl, $apiKey, $secret, $client_id)
    {
        $this->api = Http::withOptions([
            'base_uri' => $apiUrl,
        ])->withHeaders([
            $apiKey => $secret
        ]);
        $this->client_id = $client_id;
    }

    public function getData($data_path)
    {
        switch ($data_path) {
            case 'dashboard':
                $data = $this->getDashboardData();
                break;
            case 'orders':
                $data = $this->getOrderData();
                break;
            case 'asns-inventory':
                $data = $this->getAsnInventoryData();
                break;
            case 'returns':
                $data = $this->getReturnData();
                break;
            default:
                $data = (object)['status' => 404, 'message' => 'Data endpoint not found!'];
                break;
        }

        return $data;
    }
    public function getDashboardData(): Dashboard
    {
        return Dashboard::fromArray(
            $this->api->get("/v1/dashboard/client/{$this->client_id}")->json() ?? []
        );
    }
    public function getOrderData(): SalesOrderDashboard
    {
        return SalesOrderDashboard::fromJson(
            $this->api->get("/v1/dashboard/sales-orders/{$this->client_id}")->json() ?? []
        );
    }
    public function getAsnInventoryData(): AsnInventoryDashboard
    {
        $apiData = $this->api->get("/v1/dashboard/asn-inventory/{$this->client_id}")->json();
        return AsnInventoryDashboard::fromJson($apiData);
    }

    public function getReturnData(): ReturnsDashboard
    {
        $apiData = $this->api->get("/v1/dashboard/returns/{$this->client_id}")->json();
        return ReturnsDashboard::fromJson($apiData);
    }
}
