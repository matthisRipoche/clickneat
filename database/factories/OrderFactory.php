<?php

namespace Database\Factories;

use App\Models\Order;
use App\Models\User;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    protected $model = Order::class;

    public function definition(): array
    {
        $statuses = ['en attente', 'en cours', 'terminée', 'annulée'];

        $user = User::inRandomOrder()->first() ?? User::factory()->create();
        $restaurant = Restaurant::inRandomOrder()->first() ?? Restaurant::factory()->create();

        return [
            'name' => date('Y-m-d H:i:s') . ' : Commande de ' . $user->name,
            'user_id' => $user->id,
            'restaurant_id' => $restaurant->id,
            'total_price' => 0,
            'reserved_at' => $this->faker->dateTimeBetween('now', '+1 month'),
            'status' => $this->faker->randomElement($statuses),
        ];
    }
}
