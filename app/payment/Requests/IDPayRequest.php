<?php

namespace App\Payment\Requests;

use App\Payment\Contracts\RequestContract;

class IDPayRequest implements RequestContract
{
    public function __construct(protected $amount, protected $user, protected $order_id)
    {
        //
    }

    public function getAmount(): float|int
    {
        return $this->amount * 10;
    }

    public function getUser()
    {
        return $this->user;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }
}
