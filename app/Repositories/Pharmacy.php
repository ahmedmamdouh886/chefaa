<?php

namespace App\Repositories;

use App\Models\Pharmacy as PharmacyModel;

class Pharmacy
{
    /**
     * Pharmacy model instance.
     *
     * @var \App\Models\Pharmacy
     */
    protected PharmacyModel $pharmacyModel;

    /**
     * Instantiate a class instance.
     *
     * @param \App\Models\Pharmacy
     */
    public function __construct(PharmacyModel $pharmacyModel)
    {
        $this->pharmacyModel = $pharmacyModel;
    }

    /**
     * Paginate all pharmacies.
     *
     * @param int $perPage How many rows you want per page.
     * @param array $columns What columns you wanna fetch.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate(int $perPage = 10, array $columns = ['*'])
    {
        return $this->pharmacyModel->latest()->paginate($perPage, $columns);
    }

    /**
     * Find a pharmacy by id.
     *
     * @param int $id
     *
     * @return \App\Models\Pharmacy
     */
    public function findById(int $id, array $columns = ['*'])
    {
        return $this->pharmacyModel->findOrFail($id, $columns);
    }

    /**
     * Update a pharmacy.
     *
     * @param int $id
     * @param array $data
     *
     * @return void
     */
    public function update(int $id, array $data): void
    {
        $this->findById($id, ['id'])->update($data);
    }

    /**
     * Create a new pharamcy.
     *
     * @param array $data
     *
     * @return void
     */
    public function create(array $data): void
    {
        $this->pharmacyModel->create($data);
    }

    /**
     * Delete a pharamcy.
     *
     * @param int $id
     *
     * @return void
     */
    public function delete(int $id): void
    {
        $this->findById($id)->delete();
    }
}
