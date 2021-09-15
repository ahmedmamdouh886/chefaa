<?php

namespace App\Support\Payments\V1;

final class VodafoneCashPayment extends AbstractPayment
{
    /**
     * Payment way.
     *
     * @var string
     */
    protected $paymentWay = 'Vodafone cash';

    /**
     * Pay.
     *
     * @var string
     */
    public function pay(string $price)
    {
        // TODO: Vodafone cash payment implementation.
    }
}
