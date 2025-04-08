<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;




/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $faker = \Faker\Factory::create('fr_FR');
        $faker->addProvider(new \FakerRestaurant\Provider\fr_FR\Restaurant($faker));
        return [
            'name' => $faker->foodName(),
            'category_id' => random_int(1, 12),
            'price' => random_int(100, 1000),
            'cost' => random_int(50, 500),
        ];
    }
}
