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
}
