<?php

namespace Database\Factories;

use App\Models\Item;
use App\Models\Order;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrderItemFactory extends Factory
{
    /**
     * Définir l'état par défaut du modèle.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        // Récupérer une commande existante
        $order = Order::inRandomOrder()->first();

        // Récupérer l'ID du restaurant associé à la commande
        $restaurantId = $order->restaurant_id;

        // Sélectionner une catégorie qui appartient au restaurant
        $category = Category::where('restaurant_id', $restaurantId)
            ->inRandomOrder()
            ->first();

        // Sélectionner un item appartenant à la catégorie choisie
        $item = Item::where('category_id', $category->id)
            ->inRandomOrder()
            ->first() ?? Item::factory()->create(['category_id' => $category->id]);

        return [
            // L'ID de la commande à laquelle cet item appartient
            'order_id' => $order->id,

            // L'ID de l'item choisi dans la commande
            'item_id' => $item->id,

            // Le prix de l'item en centimes
            'price' => (int)($item->price * 100), // Convertir en centimes

            // Quantité aléatoire entre 1 et 5
            'quantity' => $this->faker->numberBetween(1, 5),
        ];
    }
}
