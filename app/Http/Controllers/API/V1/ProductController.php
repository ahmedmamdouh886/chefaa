<?php

namespace App\Http\Controllers\API\V1;

use App\Http\Controllers\Controller;
use App\Http\Requests\API\V1\StoreProductRequest;
use App\Http\Requests\API\V1\UpdateProductRequest;
use App\Http\Resources\API\V1\ProductResource;
use App\Repositories\ProductRepository;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    /**
     * Product repository instance.
     * 
     * @var \App\Repositories\ProductRepository
     */
    protected ProductRepository $productRepoInstance;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Repositories\ProductRepository
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProductRepository $productRepoInstance)
    {
        $this->productRepoInstance = $productRepoInstance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return ProductResource::collection($this->productRepoInstance->paginate());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreProductRequest $request)
    {
        $this->productRepoInstance->create($request->only('title', 'description', 'price', 'quantity'));

        return response()->json(['message' => __('messages.created_successfully')], Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ProductResource($this->productRepoInstance->findById($id));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateProductRequest $request, $id)
    {
        $this->productRepoInstance->update($id, $request->only('title', 'description', 'price', 'quantity'));

        return response()->json(['message' => __('messages.created_successfully')], Response::HTTP_NO_CONTENT);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->productRepoInstance->delete($id);

        return response()->json([], Response::HTTP_NO_CONTENT);
    }
}
