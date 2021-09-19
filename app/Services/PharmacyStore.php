<?php

namespace App\Services;

use App\Repositories\PharmacyStore as PharmacyStoreRepository;

class PharmacyStore
{
    /**
     * Pharmacy model instance.
     *
     * @var \App\Repositories\PharmacyStore
     */
    protected PharmacyStoreRepository $pharmacyStoreRepository;

    /**
     * Instantiate a class instance.
     *
     * @param \App\Repositories\PharmacyStore $pharmacyStoreRepository
     */
    public function __construct(PharmacyStoreRepository $pharmacyStoreRepository)
    {
        $this->pharmacyStoreRepository = $pharmacyStoreRepository;
    }

    /**
     * handle pharmacy product store.
     *
     * @param int $productId
     * @param array $pharmaciesProductDetails ['pharmacy_id' => '', 'quanitity' => '', 'price' => '']
     *
     * @return void
     */
    public function handle(int $productId, array $pharmaciesProductDetails): void
    {
        $formattedPharmaciesProductDetails = [];
        collect($pharmaciesProductDetails)->each(function ($singlePharmacyProductDetails) use (&$formattedPharmaciesProductDetails) {
            $formattedPharmaciesProductDetails[$singlePharmacyProductDetails['pharmacy_id']] = [
                'price' => $singlePharmacyProductDetails['price'],
                'quantity' => $singlePharmacyProductDetails['quantity'],
            ];
        });

        $this->pharmacyStoreRepository->addOrUpdateProductToMultiplePharmacies($productId, $formattedPharmaciesProductDetails);
    }
}
