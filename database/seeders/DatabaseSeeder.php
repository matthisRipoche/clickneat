<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Item;
use App\Models\Restaurant;
use App\Models\Category;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Créer des restaurants, catégories et items
        $restaurants = Restaurant::factory(3)->create();
        Category::factory(12)->create();
        Item::factory(50)->create();

        // Créer des utilisateurs
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'role' => 'admin',
        ]);
        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@test.com',
            'password' => Hash::make('manager'),
            'role' => 'manager',
        ]);
        User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => Hash::make('user'),
            'role' => 'user',
        ]);

        // Créer quelques utilisateurs supplémentaires
        User::factory(10)->create();

        // Créer des commandes et associer les items à chaque commande
        Order::factory()
            ->count(10)
            ->create()
            ->each(function ($order) use ($restaurants) {
                // Créer des OrderItems associés à la commande
                $items = OrderItem::factory()
                    ->count(rand(1, 5)) // Crée entre 1 et 5 items pour chaque commande
                    ->create([
                        'order_id' => $order->id, // Lier l'OrderItem à l'Order
                    ]);

                // Calculer le prix total en centimes
                $total = $items->sum(fn($item) => $item->price * $item->quantity);

                // Mettre à jour la commande avec le prix total
                $order->update(['total_price' => $total]);
            });
    }
}
