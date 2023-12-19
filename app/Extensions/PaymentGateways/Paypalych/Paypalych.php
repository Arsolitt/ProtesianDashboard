<?php

namespace App\Extensions\PaymentGateways\Paypalych;

class Paypalych {

    public readonly string $shopId;
    public readonly string $apiToken;

    public function __construct($shopId, $apiToken) {
        $this->shopId = $shopId;
        $this->apiToken = $apiToken;
    }

    public function getResponse($route = null, $method = null, $next = null) {

        $route = ($route != null) ? "https://paypalych.com/api/v1/".$route : "https://paypalych.com/api/v1/";
        $params = array();

        if($next != null) {
            $params = array_merge($params, $next);
        }

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $route);
        if($method == "POST") { curl_setopt($ch, CURLOPT_POST, true); } else { curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); }
        curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($params));
        curl_setopt($ch, CURLOPT_USERAGENT, "composer require tellarion/paypalych V-Agent");
        curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer ".$this->apiToken));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;

    }

    public function testValid() {

        return $this->getResponse("payment/status?id=lGPmp4mYeE", "GET", "");

    }

    public function billCreate($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("bill/create", "POST", $array);
    }

    public function billToogleActivity($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("bill/toggle_activity", "POST", $array);

    }

    public function billPayments($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("bill/payments", "GET", $array);

    }

    public function billSearch($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("bill/search", "GET", $array);

    }

    public function billStatus($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("bill/status", "GET", $array);

    }

    public function paymentSearch($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payment/search", "GET", $array);

    }

    public function paymentStatus($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payment/status", "GET", $array);

    }

    public function merchantBalance($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("merchant/balance", "GET", $array);

    }

    public function payoutPersonalCreate($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payout/personal/create", "POST", $array);

    }

    public function payoutRegularCreate($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payout/regular/create", "POST", $array);

    }

    public function payoutSearch($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payout/search", "GET", $array);

    }

    public function payoutStatus($args = null) {

        $array = array();

        if($args != null) {
            $array = array_merge($array, $args);
        }

        return $this->getResponse("payout/status", "GET", $array);

    }



}
