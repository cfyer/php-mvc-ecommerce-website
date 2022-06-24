<?php

namespace App\Payment\Gateways;

use App\Payment\Contracts\PayContract;
use App\Payment\Contracts\VerifyContract;
use App\Payment\Requests\IDPayRequest;
use App\Utilities\Redirect;
use InvalidArgumentException;

class IDPay implements PayContract, VerifyContract
{
    protected $successfulStatus = 100;

    public function __construct(protected $request)
    {
        //
    }

    public function pay()
    {
        $params = array(
            'order_id' => $this->request->getOrderId(),
            'amount' => $this->request->getAmount(),
            'name' => $this->request->getUser()->fullname,
            'mail' => $this->request->getUser()->email,
            'callback' => 'http://weshop.php/payment/callback/',
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 6a7f99eb-7c20-4412-a972-6dfb7cd253a4',
            'X-SANDBOX: 1'
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['error_code'])) {
            throw new InvalidArgumentException($result['error_message']);
        }

        return Redirect::to($result['link']);
    }

    public function verify()
    {
        $params = array(
            'id' => $this->request->getId(),
            'order_id' =>  $this->request->getOrderId(),
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'https://api.idpay.ir/v1.1/payment/verify');
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($params));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            'Content-Type: application/json',
            'X-API-KEY: 6a7f99eb-7c20-4412-a972-6dfb7cd253a4',
            'X-SANDBOX: 1',
        ));

        $result = curl_exec($ch);
        curl_close($ch);

        $result = json_decode($result, true);

        if (isset($result['error_code'])) {
           return false;
        }

        if (isset($result['status']) && $result['status'] == $this->successfulStatus) {
            return $result;
        }

        return false;
    }
}
