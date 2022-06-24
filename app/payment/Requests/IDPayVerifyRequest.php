<?php

namespace App\Payment\Requests;

use App\Payment\Contracts\RequestContract;

class IDPayVerifyRequest implements RequestContract
{
    public function __construct(protected $id, protected $order_id)
    {
        //
    }

    public function getId()
    {
        return $this->id;
    }

    public function getOrderId()
    {
        return $this->order_id;
    }
}
