<?php

namespace App\Services;

use App\Dto\AccountDashBoard;
use App\Dto\AsnInventoryDashboard;
use App\Dto\ReturnsDashBoard;
use App\Dto\SalesOrdersDashboard;
use App\Models\Notification;
use Faker\Factory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class Rushmore {
    protected $key;
    protected $user;
    protected $accountId;
    protected $api;

    public $faker;

    public static $subscriptions = [
        'easy_order' => 'EasyOrder',
        'omni_fill' => 'OmniFill',
        'global' => 'Global',
        'OWDRep'
    ];
    public static $permissions = [
        'accounts',
        'contact center',
        'orders',
        'returns',
        'reports',
        'inventory manager',
        'chat',
        'billing'
    ];

    public static $shippingMethods = [
        '2 Day',
        'DHL Express Worldwide (nondoc)',
        'Economy',
        'FedEx Priority Overnight',
        'Ground',
        'International Economy',
        'International Expedited',
        'LTL',
        'Overnight',
        'Standard Priority'
    ];

    public static $reportTypes = ['sales-orders','inventory','returns'];

    public function __construct($apiUrl, $apiKey, $accountId) {
        $this->faker = Factory::create();
        $this->api = Http::withOptions([
            'base_uri' => $apiUrl,
        ])->withHeaders([
            'owd-api-key' => $apiKey
        ]);
        $this->accountId = $accountId;
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
            case 'returns':
                $data = $this->getReturnData();
                break;
            case 'asns-inventory':
                $data = $this->getAsnInventoryData();
                break;

            default:
                $data = (object)['status' => 404, 'message' => 'Data endpoint not found!'];
                break;
        }

        return $data;
    }

    public function getDashboardData(): AccountDashBoard
    {
        return AccountDashBoard::fromArray(
            $this->api->get("/account-dashboard/{$this->accountId}")->json() ?? []
        );
    }

    public function getOrderData(): SalesOrdersDashboard
    {
        return SalesOrdersDashboard::fromArray(
            $this->api->get("/sales-orders-dashboard/{$this->accountId}")->json() ?? []
        );
    }

    public function getReturnData(): ReturnsDashBoard
    {
        $apiData = $this->api->get("/returns-dashboard/{$this->accountId}")->json();
        return ReturnsDashBoard::fromArray($apiData);
    }

    public function getAsnInventoryData(): AsnInventoryDashboard
    {
        $apiData = $this->api->get("/asn-inventory-dashboard/{$this->accountId}")->json();
        return AsnInventoryDashboard::fromArray($apiData);
    }

    public function getUserData(){
        if( !$this->user ){
            $this->user = $this->generateFakeUser();
            session(['user' => json_encode($this->user)]);
        }

        return $this->user;
    }

    public function logout(){
        session()->forget('user');
    }

    public function updateUser(Request $request) {
        $this->getUserData();

        if ( $request->has('regen-data') ) {
            $this->user = $this->generateFakeUser();
        }

        $this->user->subscription = $request->user['subscription'];
        $this->user->permissions = $request->has('user.permissions') ? array_keys($request->user['permissions']) : [];

        session(['user' => json_encode($this->user)]);
        return redirect()->back();
    }

    /* vvvvvvvv DEMO DATA FUNCTIONS vvvvvvvv */

    private function generateFakeUser(){
        $name = 'Demo User';
        $company = $this->faker->company;
        $email = filter_var(strtolower("$name@$company.com"), FILTER_SANITIZE_EMAIL);
        return (object) [
            'name' => $name,
            'email' => $email,
            'role' => 'Admin',
            'company' => $company,
            'companyLogo' => '/img/walmart-logo.png',
            'pfp' => "https://source.unsplash.com/random/128x128?user=$name",
            'dateJoined' => $this->faker->date('m F Y'),

            'subscription' => self::$subscriptions['easy_order'],
            'permissions' => self::$permissions,
            'shopifyMerchantId' => '918231230ASD123123',
            'apiSubKey' => 'AB321DS987SDAAB321DS9'
        ];
    }

    public function getNotificationData() {
        $notifications = Notification::factory()->count(22)->make()->sortByDesc('publish_date');
        foreach ($notifications as $key => $notify) {
            $notifications[ $key ]->id = $key;
        }
        return $notifications;
    }

    public function getReports()
    {
        //sales-orders, inventory, returns\
        /*{
      "id": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
      "viewName": "string",
      "columnsContent": [
        {
          "level": 0,
          "content": "string"
        }
      ],
      "searchCriteria": [
        {
          "scKey": "scValue"
        }
      ],
      "searchCriteriaQueryString": "?scKey=scValue",
      "pageSize": 0,
      "sortBy": "string",
      "sortDirection": "asc",
      "createdDate": "2021-12-12T19:19:10.935Z",
      "createdByUserName": "string",
      "modifiedDateTime": "2021-12-12T19:19:10.935Z",
      "modifiedByUserName": "string"
    }
         * */
        //$reportType = 'sales-orders';
        $sales = $this->api->get("/account-settings/{$this->accountId}/reports-views/sales-orders")->json();
        //$reportType = 'inventory';
        $inventory = $this->api->get("/account-settings/{$this->accountId}/reports-views/inventory")->json();
        //$reportType = 'returns';
        $returns = $this->api->get("/account-settings/{$this->accountId}/reports-views/returns")->json();

        return [
            'sales' => $sales['reportViews'] ?? [],
            'inventory' => $inventory['reportViews'] ?? [],
            'returns' => $returns['reportViews'] ?? [],
        ];
    }

    public function getReportConfig($reportType, $reportId): array
    {
        if (!in_array($reportType, self::$reportTypes, true)) {
            throw new \Exception('Unknown report type');
        }
        $url = "/account-settings/{$this->accountId}/reports-views/{$reportType}/{$reportId}";
        $reportConfig = $this->api->get($url)->json();
        //check if we get some data and put it in VO
        if (isset($reportConfig['errorResponses'])) {
            Log::error('Error during getting report config', [
                'accountId' => $this->accountId,
                'reportType' => $reportType,
                'reportId' => $reportId,
                'apiResponse' => $reportConfig['errorResponses'],
            ]);
            throw new \Exception('Error during getting report config');
        }

        return $reportConfig;
    }
}
