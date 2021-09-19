<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        // TODO: Should be in a provider layer.
        $medicines = ['Panadol', 'Depaken', 'Cold & Flu', 'Mayo Clinic', 'Paracetamol', 'ibuprofen', 'Paracetamol'];

        return [
            'title' => $medicines[array_rand($medicines)],
            'description' => $this->faker->text(100)
        ];
    }
}
