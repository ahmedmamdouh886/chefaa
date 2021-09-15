<?php

namespace App\Repositories;

use App\Models\Product;

class ProductRepository
{
    /**
     * Product model instance.
     * 
     * @var \App\Models\Product
     */
    protected Product $productModel;

    /**
     * Instantiate a class instance.
     * 
     * @param \App\Models\Product
     */
    public function __construct(Product $productModel)
    {
        $this->productModel = $productModel;
    }

    /**
     * Paginate all products.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        return $this->productModel->latest()->paginate(10, ['id', 'title', 'price', 'quantity', 'created_at']);
    }

    /**
     * Find a product by id.
     *
     * @param int $id
     * 
     * @return \App\Models\Product
     */
    public function findById(int $id)
    {
        return $this->productModel->findOrFail($id, ['id', 'title', 'description', 'price', 'quantity', 'created_at']);
    }

    /**
     * Update a product.
     *
     * @param int $id
     * @param array $data
     * 
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $this->productModel->where('id', $id)->update($data);
    }

    /**
     * Create a new product.
     *
     * @param array $data
     * 
     * @return void
     */
    public function create(array $data): void
    {
        $this->productModel->create($data);
    }

    /**
     * Delete a product.
     *
     * @param int $id
     * 
     * @return void
     */
    public function delete(int $id): void
    {
        $this->productModel->findOrFail($id)->delete();
    }
}
