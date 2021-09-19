<?php

namespace Database\Seeders;

use App\Models\Pharmacy;
use App\Models\Product;
use Exception;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class PharmacyProductStoreSeeder extends Seeder
{
    /**
     * Pharmacy rows count.
     * 
     * @var int
     */
    const PHARMACY_ROWS_COUNT = 20000;

    /**
     * Rows count.
     * 
     * @var int
     */
    const PRODUCT_ROWS_COUNT = 30000;

    /**
     * Random rows count selection.
     * 
     * @var int
     */
    const RANDOM_ROWS_COUNT_SELECTION = 8;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // TODO: Refactor it to reduce the time/space complexity.
       
        Pharmacy::insert(Pharmacy::factory()->count(self::PHARMACY_ROWS_COUNT)->make()->toArray());
        Product::insert(Product::factory()->count(self::PRODUCT_ROWS_COUNT)->make()->toArray());
        $products = Product::all(['id']);

        Pharmacy::get(['id'])->each(function ($pharmacy) use ($products) {
            $pharmacy->products()->attach(
                $this->formatPharmaciesProductsStore($products->random(self::RANDOM_ROWS_COUNT_SELECTION)->pluck('id')->toArray())
            );
        });
    }

    /**
     * generate price quantity for pivot Table.
     * 
     * @param array $productsId Products ids.
     */
    private function formatPharmaciesProductsStore(array $productsIds): array
    {
        $pharmaciesProductStore = [];

        $faker = $this->IntializeFakerInstance();

        foreach ($productsIds as $productId) {
            $pharmaciesProductStore[$productId] = [
                'price' => $faker->randomDigitNotZero(),
                'quantity' => $faker->randomDigitNotZero()
            ];
        }

        return $pharmaciesProductStore;
    }

    /**
     * Intialize faker
     */
    private function IntializeFakerInstance()
    {
        return Faker::create();
    }
}
