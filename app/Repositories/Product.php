<?php

namespace App\Repositories;

use App\Models\Product as ProductModel;

class Product
{
    /**
     * Product model instance.
     *
     * @var
     */
    protected $productModel;

    /**
     * Product model instance.
     *
     * @var \App\Repositories\PharmacyRepository
     */
    protected Pharmacy $pharmacyRepository;

    /**
     * Instantiate a class instance.
     *
     * @param \App\Models\Product $productModel $productModel
     * @param \App\Repositories\PharmacyRepository $pharmacyRepository
     */
    public function __construct(ProductModel $productModel, Pharmacy $pharmacyRepository)
    {
        $this->productModel = $productModel;
        $this->pharmacyRepository = $pharmacyRepository;
    }

    /**
     * Paginate all products.
     *
     * @param int $perPage How many rows you want per page.
     * @param array $columns What columns you wanna fetch.
     * @param array $filters data to filter the products by title or wahtever.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(int $perPage = 10, array $columns = ['*'], array $filters = [])
    {
        return $this->productModel->filter($filters)->latest()->paginate($perPage, $columns);
    }

    /**
     * Load relations for collection.
     *
     * @param array|string $relations some eager loading relations for collection of models.
     *
     * @return $this
     */
    public function with(...$relations)
    {
        $this->productModel = $this->productModel->with($relations);

        return $this;
    }

    /**
     * Load relations for single instance.
     *
     * @param array|string $relations some eager loading relations for single instance model.
     *
     * @return $this
     */
    public function load(...$relations)
    {
        $this->productModel = $this->productModel->load($relations);

        return $this;
    }

    /**
     * Find a product by id.
     *
     * @param int $id product id.
     *
     * @return \App\Models\Product
     */
    public function findById(int $id, $columns = ['*'])
    {
        return $this->productModel->findOrFail($id, $columns);
    }

    /**
     * Update a product.
     *
     * @param int $id product id.
     * @param array $data data to be created.
     *
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $this->findById($id, ['id'])->update($data);
    }

    /**
     * Create a new product.
     *
     * @param array $data data to be created.
     *
     * @return int
     */
    public function create(array $data): int
    {
        return $this->productModel->create($data)->id;
    }

    /**
     * Delete a product.
     *
     * @param int $id product id.
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }
}
