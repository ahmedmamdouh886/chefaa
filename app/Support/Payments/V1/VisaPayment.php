<?php

namespace App\Support\Payments\V1;

final class VisaPayment extends AbstractPayment
{
    /**
     * Payment way.
     *
     * @var string
     */
    protected $paymentWay = 'Visa';

    /**
     * Pay.
     *
     * @var string
     */
    public function pay(string $price)
    {
        // TODO: Visa payment implementation.
    }
}
