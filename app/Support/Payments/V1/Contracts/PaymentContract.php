<?php

namespace App\Support\Payments\V1\Contracts;

interface PaymentContract
{
    /**
     * Pay.
     *
     * @var string
     */
    public function pay(string $price);
}
