<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StorePharmacyRequest;
use App\Http\Requests\API\V1\UpdatePharmacyRequest;
use App\Http\Resources\API\V1\PharmacyResource;
use App\Repositories\Pharmacy as PharmacyRepository;
use Illuminate\Http\Response;

class PharmacyController extends Controller
{
    /**
     * Per page.
     *
     * @var int How many rows you want in each pagination page.
     */
    const PER_PAGE = 10;

    /**
     * Pharmacy repository instance.
     *
     * @var \App\Repositories\PharmacyRepository Pharmacy repository.
     */
    protected PharmacyRepository $pharmacyRepoInstance;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Repositories\PharmacyRepository Pharmacy repository.
     * @return \Illuminate\Http\Response
     */
    public function __construct(PharmacyRepository $pharmacyRepoInstance)
    {
        $this->pharmacyRepoInstance = $pharmacyRepoInstance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return PharmacyResource::collection($this->pharmacyRepoInstance->paginate(self::PER_PAGE, ['id', 'name', 'address']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePharmacyRequest $request)
    {
        $this->pharmacyRepoInstance->create($request->only('name', 'address'));

        return response()->json(['message' => __('messages.created_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id Pharmacy id.
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new PharmacyResource($this->pharmacyRepoInstance->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request  $request
     * @param int $id Pharmacy id.
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePharmacyRequest $request, $id)
    {
        $this->pharmacyRepoInstance->update($id, $request->only('name', 'address'));

        return response()->json([], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id Pharmacy id.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pharmacyRepoInstance->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
