<?php

namespace App\Http\Controllers;

use App\Repositories\Pharmacy as PharmacyRepository;
use Illuminate\Http\Request;

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
     * @return \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('pharmacies.index', ['pharmacies' => $this->pharmacyRepoInstance->paginate(self::PER_PAGE, ['id', 'name', 'address'])]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id pharmacy id.
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->pharmacyRepoInstance->delete($id);
        
        return back();
    }
}
