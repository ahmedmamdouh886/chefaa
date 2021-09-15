<?php

namespace App\Repositories;

use App\Models\Pharmacy;

class PharmacyRepository
{
    /**
     * Pharmacy model instance.
     *
     * @var \App\Models\Pharmacy
     */
    protected Pharmacy $pharmacyModel;

    /**
     * Instantiate a class instance.
     *
     * @param \App\Models\Pharmacy
     */
    public function __construct(Pharmacy $pharmacyModel)
    {
        $this->pharmacyModel = $pharmacyModel;
    }

    /**
     * Paginate all pharmacies.
     *
     * @return \Illuminate\Http\Response
     */
    public function paginate()
    {
        return $this->pharmacyModel->latest()->paginate(10, ['id', 'name', 'address', 'created_at']);
    }

    /**
     * Find a pharmacy by id.
     *
     * @param int $id
     *
     * @return \App\Models\Pharmacy
     */
    public function findById(int $id)
    {
        return $this->pharmacyModel->findOrFail($id, ['id', 'name', 'address']);
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
        $this->pharmacyModel->where('id', $id)->update($data);
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
        $this->pharmacyModel->findOrFail($id)->delete();
    }
}
