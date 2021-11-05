<?php

namespace App\View\Components;
use Illuminate\View\Component;

class ProfileContent extends Component {
    public $company;
    public $email;
    public $role;
    public $subscription;
    public $dateJoined;
    public $companyLogo;
    public $shopifyMerchantId;
    public $apiSubKey;

    public function __construct($company, $email, $role, $subscription, 
                                $dateJoined, $companyLogo, $shopifyMerchantId, $apiSubKey) {
        $this->company = $company;
        $this->email = $email;
        $this->role = $role;
        $this->subscription = $subscription;
        $this->dateJoined = $dateJoined;
        $this->companyLogo = $companyLogo;
        $this->shopifyMerchantId = $shopifyMerchantId;
        $this->apiSubKey = $apiSubKey;
    }

    public function render() {
        return view('components.profile-content');
    }
}