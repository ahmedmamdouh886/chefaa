<?php

namespace App\Support\Payments\V1;

final class FawryPayment extends AbstractPayment
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
     * @var string $price
     */
    public function pay(string $price)
    {
        // TODO: Fawry payment implementation.
    }
}
