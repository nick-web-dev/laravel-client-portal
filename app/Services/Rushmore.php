<?php

namespace App\Services;

use Illuminate\Http\Request;
use App\Models\Notification;
use Faker\Factory;
use Carbon\Carbon;
use Session;

class Rushmore {
    protected $key;
    protected $base_url;
    protected $user;

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

    public function __construct() {
        $this->faker = Factory::create();
    }

    public function getData($data_path){
        return $this->generateFakeData( $data_path );
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

    public function getDashboardData() {
        return [
            'fulfillment' => [
                'percent' => 100,
                'accuracy' => 1,
                'savings' => rand(9500, 19999)
            ],
            'orders' => [
                'total' => rand(25, 1000),
                'onHold' => rand(0, 15),
                'status' => rand(75, 100),
            ],
            'asn_receives' => [
                'pending' => rand(0, 10),
                'arrived' => rand(0, 10),
                'in_process' => rand(0, 10),
                'nonconforming' => rand(0, 20),
            ],
            'inventory' => [
                'outOfStock' => rand(0, 5),
                'lowInventory' => rand(0, 20),
            ]
        ];
    }

    public function getOrderData() {
        $date = Carbon::now()->startOfDay();
        $stop_date = Carbon::now()->sub(365, 'days');

        $orders = collect();
        $count = rand(0, 50);

        $shippedOrders = collect();
        $ordersByMethod = collect();

        while( $date->isAfter($stop_date) && $orders->count() < 10000 ){
            $count += rand(0, 12) - 6;
            $count = max($count, 0);

            $dayMethod = [
                'date' => $date->clone(),
                'methods' => []
            ];

            foreach( self::$shippingMethods as $method ){
                array_push($dayMethod['methods'], [
                    'name' => $method,
                    'total' => ($method == 'Economy' ? rand(500, 1000) : rand(0, 100))
                ]);
            }

            $ordersByMethod->push( $dayMethod );

            if( $date->is('sunday') || $date->is('saturday') ){
                $shippedOrders->push([
                    'date' => $date->clone(),
                    'channels' => [
                        ['name' => 'Amazon', 'total' => rand(0, 10)],
                        ['name' => 'Walmart', 'total' => rand(0, 10)],
                        ['name' => 'Shopify', 'total' => rand(0, 10)],
                    ]
                ]);
            } else {
                $shippedOrders->push([
                    'date' => $date->clone(),
                    'channels' => [
                        ['name' => 'Amazon', 'total' => rand(0, 700)],
                        ['name' => 'Walmart', 'total' => rand(0, 700)],
                        ['name' => 'Shopify', 'total' => rand(0, 700)],
                    ]
                ]);
            }

            for ($i=$count; $i > 0; $i--) { 
                $orders->push((object)[
                    'date' => $date->clone(),
                    'value' => rand(10, 100),
                    'name' => 'Product Name',
                    'code' => 'CODE-' . rand(100, 999),
                    'img' => '/img/shirt.svg',
                    'channel' => ['Shopify', 'Walmart', 'Amazon'][rand(0,2)],
                    'status' => ['shipped', 'hold', 'completed'][rand(0,2)],
                    'method' => ['Express', 'Air', 'Standard'][rand(0,2)],
                ]);
            }
            $date = $date->sub(1, 'day');
        }
        $todayOrders = $orders->filter(function($order){
            return $order->date->isToday();
        });

        $orderSummary['posted'] = rand(200, 500);
        $orderSummary['onHold'] = rand(0, 8);
        $orderSummary['completed'] = rand(200, $orderSummary['posted']);
        $orderSummary['status'] = $orderSummary['completed'] / $orderSummary['posted'] * 100;

        return [
            'orderSummary' => $orderSummary,
            'shippedOrders' => $shippedOrders,
            'ordersByMethod' => $ordersByMethod,
            'orders' => $orders,
        ];
    }

    public function getNotificationData() {
        $notifications = factory(Notification::class, 22)->make()->sortByDesc('publish_date');
        foreach ($notifications as $key => $notify) {
            $notifications[ $key ]->id = $key;
        }
        return $notifications;
    }

    public function getReturnData() {
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

        return (object)[
            'returnedUnits' => $returns->values(),
            'returnedOrders' => $orders->values(),
            'averageReturns' => [
                'orders' => rand(2000, 5000),
                'unitsPerOrder' => rand(1, 30) / 10
            ],
            'returnRate' => rand(2, 8)
        ];
    }

    public function getInventoryData() {
        $products = collect();

        while( $products->count() < 300 ){
            $products->push((object)[
                'name' => "Product " . ucfirst($this->faker->word),
                'code' => strtoupper( $this->faker->lexify('product-???') ),
                'img' => "/img/shirt.svg",
                'accuracy' => rand(45, 100)
            ]);
        }
        return [
            'cyclecounted' => $products->toArray(),
            'outOfStock' => rand(0, 15),
            'lowInventory' => rand(0, 50),
            'damaged' => rand(0, 20),
        ];
    }
  
    public function getASNData() {
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
        return (object)[
            'asn_highlights' => [
                'pending' => rand(1,50),
                'arrived' => rand(1,50),
                'inProcess' => rand(1,50),
                'nonConforming' => rand(1,50)
            ],
            'nonconforming' => $nonconforming
        ];
    }
}