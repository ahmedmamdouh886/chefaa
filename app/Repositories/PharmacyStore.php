<?php

namespace App\Repositories;

use App\Repositories\Product;

class PharmacyStore
{
    /**
     * Pharmacy store model instance.
     *
     * @var \App\Repositories\Product $productRepository
     */
    protected Product $productRepository;

    /**
     * Instantiate a class instance.
     *
     * @param \App\Repositories\Product $productRepository
     */
    public function __construct(Product $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    /**
     * Create a new pharamcy.
     *
     * @param array $pharmaciesProductDetails
     *
     * @return void
     */
    public function addOrUpdateProductToMultiplePharmacies(int $productId, array $pharmaciesProductDetails): void
    {
        $this->productRepository->findById($productId)->pharmacies()->sync($pharmaciesProductDetails);
    }

    /**
     * Get cheapest pharmacies prices of product id.
     *
     * @param int $productId
     */
    public function getCheapestPharmaciesPricesOf(int $productId)
    {
        return $this->productRepository->findById($productId)
        ->pharmacies()
        ->orderByPivot('price', 'asc')
        ->get(['pharmacies.id', 'pharmacies.name', 'price'])
        ->take(5);
    }
}
