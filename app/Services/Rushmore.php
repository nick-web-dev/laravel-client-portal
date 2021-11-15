<?php

namespace App\Services;

use App\Dto\AccountDashBoard;
use App\Dto\SalesOrdersDashboard;
use App\Models\Notification;
use Carbon\Carbon;
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
            case 'asns':
                $data = $this->getASNData();
                break;
            case 'inventory':
                $data = $this->getInventoryData();
                break;

            default:
                $data = (object)['status' => 404, 'message' => 'Data endpoint not found!'];
                break;
        }

        return $data;
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

    public function generateFakeData($data_path) {
        $data = (object)[];
        switch ( $data_path ) {
            case 'dashboard':   $data = $this->getDashboardData();  break;
            case 'orders':      $data = $this->getOrderData();      break;
            case 'returns':     $data = $this->getReturnData();     break;
            case 'asns':        $data = $this->getASNData();        break;
            case 'inventory':   $data = $this->getInventoryData();  break;

            default: $data = ['status' => 404, 'message' => 'Data endpoint not found!']; break;
        }
        return json_decode(json_encode( $data ));
    }

    public function getDashboardData()
    {
        return AccountDashBoard::fromArray(
            $this->api->get("/account-dashboard/{$this->accountId}")->json() ?? []
        );
    }

    public function getOrderData() {
        return SalesOrdersDashboard::fromArray(
            $this->api->get("/sales-orders-dashboard/{$this->accountId}")->json() ?? []
        );
    }

    public function getNotificationData() {
        $notifications = Notification::factory()->count(22)->make()->sortByDesc('publish_date');
        foreach ($notifications as $key => $notify) {
            $notifications[ $key ]->id = $key;
        }
        return $notifications;
    }

    public function getReturnData() {
        //$this->api->get("/returns-dashboard/{$this->accountId}")->json();
        $returns = collect();
        $orders = collect();

        $date = Carbon::now();
        $stop_date = Carbon::now()->sub(365, 'days');

        while( $date->isAfter($stop_date) ){

            $returns->push([
                'date' => $date->clone(),
                'channels' => [
                    ['name' => 'Amazon', 'total' => rand(0, 8)],
                    ['name' => 'Walmart', 'total' => rand(0, 100)],
                    ['name' => 'Shopify', 'total' => rand(0, 15)],
                ]
            ]);

            $orders->push([
                'date' => $date->clone(),
                'channels' => [
                    ['name' => 'Amazon', 'total' => rand(0, 15)],
                    ['name' => 'Walmart', 'total' => rand(0, 200)],
                    ['name' => 'Shopify', 'total' => rand(0, 20)],
                ]
            ]);

            $date = $date->sub(1, 'day');
        }


        $returns = $returns->sortBy('date');
        $orders = $orders->sortBy('date');

        return json_decode(json_encode([
            'returnedUnits' => $returns->values(),
            'returnedOrders' => $orders->values(),
            'averageReturns' => [
                'orders' => rand(2000, 5000),
                'unitsPerOrder' => rand(1, 30) / 10
            ],
            'returnRate' => rand(2, 8)
        ]));
    }

    public function getInventoryData() {
        //this->api->get("/asn-inventory-dashboard/{$this->accountId}")->json();
        $products = collect();

        while( $products->count() < 300 ){
            $products->push((object)[
                'name' => "Product " . ucfirst($this->faker->word),
                'code' => strtoupper( $this->faker->lexify('product-???') ),
                'img' => "/img/shirt.svg",
                'accuracy' => rand(45, 100)
            ]);
        }
        return json_decode(json_encode([
            'cyclecounted' => $products->toArray(),
            'outOfStock' => rand(0, 15),
            'lowInventory' => rand(0, 50),
            'damaged' => rand(0, 20),
        ]));
    }

    public function getASNData() {
        //this->api->get("/asn-inventory-dashboard/{$this->accountId}")->json();
        $nonconforming = collect();
        while($nonconforming->count() < 5) {
            $nonconforming->push((object)[
                'name' => 'ASN Number | PO Number',
                'code' => 'Status | Status Number',
                'counter' => 00,
                'indicator_status' => 'text-gray',
                'date' => 'Time'
            ]);
        }
        return json_decode(json_encode([
            'asn_highlights' => [
                'pending' => rand(1,50),
                'arrived' => rand(1,50),
                'inProcess' => rand(1,50),
                'nonConforming' => rand(1,50)
            ],
            'nonconforming' => $nonconforming
        ]));
    }
}
