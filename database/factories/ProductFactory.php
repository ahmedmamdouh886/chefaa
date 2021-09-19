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
        $productsTitles = [
            'Panadol',
            'Large Panadol',
            'Panadol small',
            'Depaken BlaBla',
            'BlaBla Depaken',
            'BlaDepakenBla',
            'Cold & Flu',
            'Bla Bla Cold & Flu',
            'Cold & Flu Bla Bla',
            'Bla Cold & Flu Bla',
            'Mayo Clinic',
            'Panablablabla',
            'BlablaPanablabla',
            'Paracetamol',
            'ibuprofen',
            'Paracetamol',
        ];

        return [
            'title' => $productsTitles[array_rand($productsTitles)],
            'description' => $this->faker->text(50),
        ];
    }
}
