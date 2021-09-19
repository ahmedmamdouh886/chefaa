<?php

namespace App\Http\Controllers;

use App\Repositories\Product as productRepository;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Per page.
     *
     * @var int How many rows you want in each pagination page.
     */
    const PER_PAGE = 10;

    /**
     * Product repository instance.
     *
     * @var \App\Repositories\ProductRepository Product repository.
     */
    protected ProductRepository $productRepoInstance;

    /**
     * Display a listing of the resource.
     *
     * @param \App\Repositories\ProductRepository Product repository.
     * @param \App\Repositories\ProductRepository Pharmacy store repository.
     * @return \Illuminate\Http\Response
     */
    public function __construct(ProductRepository $productRepoInstance)
    {
        $this->productRepoInstance = $productRepoInstance;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('products.index', ['products' => $this->productRepoInstance->paginate(self::PER_PAGE, ['id', 'title', 'description'], $request->only('title'))->appends($request->only('title'))]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('products.show', ['product' => $this->productRepoInstance->with('pharmacies')->findById($id, ['id', 'title', 'description'])]);
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
        
        return back();
    }
}
