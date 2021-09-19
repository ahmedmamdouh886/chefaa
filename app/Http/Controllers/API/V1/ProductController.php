<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StoreProductRequest;
use App\Http\Requests\API\V1\UpdateProductRequest;
use App\Http\Resources\API\V1\ProductResource;
use App\Repositories\Product as productRepository;
use App\Services\PharmacyStore;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Product repository instance.
     *
     * @var \App\Repositories\ProductRepository $productRepoInstance Product repository.
     */
    protected ProductRepository $productRepoInstance;

    /**
     * Pharmacy store service.
     *
     * @var \App\Services\PharmacyStore $pharmacyStoreService Pharmacy store service.
     */
    protected PharmacyStore $pharmacyStoreService;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Repositories\ProductRepository Product repository.
     * @param \App\Repositories\ProductRepository Pharmacy store repository.
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProductRepository $productRepoInstance, PharmacyStore $pharmacyStoreService)
    {
        $this->productRepoInstance = $productRepoInstance;
        $this->pharmacyStoreService = $pharmacyStoreService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return ProductResource::collection($this->productRepoInstance->paginate(10, ['id', 'title'], $request->only('title'))->appends($request->only('title')));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $productId = $this->productRepoInstance->create($request->only('title', 'description'));

        $this->pharmacyStoreService->handle($productId, $request->input('pharmacies') ?? []);

        return response()->json(['message' => __('messages.created_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id product id.
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource($this->productRepoInstance->with('pharmacies')->findById($id, ['id', 'title', 'description']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id product id.
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->productRepoInstance->update($id, $request->only('title', 'description', 'price', 'quantity'));

        $this->pharmacyStoreService->handle($id, $request->input('pharmacies') ?? []);

        return response()->json(['message' => __('messages.created_successfully')], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id product id.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepoInstance->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
