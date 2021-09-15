<?php

namespace App\Support\Payments\V1;

use App\Support\Payments\V1\Contracts\PaymentContract;

class PaymentManager
{
    /**
     * Price.
     *
     * @var string
     */
    protected string $price;

    /**
     * Currency.
     *
     * @var string
     */
    protected string $currency;

    /**
     * Instantiate a class instance.
     *
     * @param string $price
     * @param string $currency
     */
    public function __construct(string $price, string $currency)
    {
        $this->price = $price;
        $this->currency = $currency;
    }

    /**
     * Pay.
     *
     * @param \App\Support\Payments\V1\Contracts\PaymentContract $payment
     */
    public function pay(PaymentContract $payment)
    {
        // Note: Currency ignored for the sake of time.

        $payment->pay($this->price);
    }
}
