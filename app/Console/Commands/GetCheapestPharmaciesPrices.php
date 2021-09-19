<?php

namespace App\Console\Commands;

use App\Http\Resources\API\V1\PharmacyResource;
use App\Repositories\PharmacyStore;
use Illuminate\Console\Command;

class GetCheapestPharmaciesPrices extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'products:search-cheapest {productId}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get cheapest pharmacies prices.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(PharmacyStore $pharmacyStore)
    {
        $this->info($pharmacyStore->getCheapestPharmaciesPricesOf($this->argument('productId')));
    }
}
