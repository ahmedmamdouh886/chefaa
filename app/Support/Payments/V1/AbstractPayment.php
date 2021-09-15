<?php

namespace App\Support\Payments\V1;

use App\Support\Payments\V1\Contracts\PaymentContract;

abstract class AbstractPayment implements PaymentContract
{
    /**
     * Payment way.
     *
     * @var string
     */
    protected string $paymentWay = 'None';

    /**
     * Get patment way.
     *
     * @return string
     */
    public function getPatmentWay()
    {
        return $this->paymentWay;
    }
}
