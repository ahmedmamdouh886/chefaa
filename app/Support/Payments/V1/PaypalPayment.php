<?php

namespace App\Support\Payments\V1;

final class PaypalPayment extends AbstractPayment
{
    /**
     * Payment way.
     *
     * @var string
     */
    protected $paymentWay = 'Paypal';

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
