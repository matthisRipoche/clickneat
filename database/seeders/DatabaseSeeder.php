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
    public function run(): void
    {
        // Étape 1 : Crée les restos D'ABORD
        $restaurants = Restaurant::factory(3)->create();

        // Étape 2 : Crée les users liés
        User::factory()->create([
            'name' => 'admin',
            'email' => 'admin@test.com',
            'password' => Hash::make('admin'),
            'restaurant_id' => null,
            'role' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'manager',
            'email' => 'manager@test.com',
            'password' => Hash::make('manager'),
            'restaurant_id' => $restaurants[0]->id,
            'role' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'manager2',
            'email' => 'manager2@test.com',
            'password' => Hash::make('manager2'),
            'restaurant_id' => null,
            'role' => 'manager',
        ]);

        User::factory()->create([
            'name' => 'user',
            'email' => 'user@test.com',
            'password' => Hash::make('user'),
            'restaurant_id' => null,
            'role' => 'user',
        ]);

        // Users random
        User::factory(10)->create();

        // Catégories et items
        Category::factory(12)->create();
        Item::factory(50)->create();

        // Une commande par user
        User::all()->each(function ($user) {
            $order = Order::factory()->create([
                'name' => date('Y-m-d H:i:s') . ' : Commande de ' . $user->name,
                'user_id' => $user->id,
                'status' => 'finished',
            ]);

            $items = collect();

            for ($i = 0; $i < rand(1, 5); $i++) {
                $item = Item::inRandomOrder()->first();

                $orderItem = OrderItem::factory()->create([
                    'order_id' => $order->id,
                    'item_id' => $item->id,
                    'price' => $item->price,
                    'quantity' => rand(1, 3),
                    'name' => $item->name,
                    'cost' => $item->cost,
                ]);

                $items->push($orderItem);
            }

            $total = $items->sum(fn($item) => $item->price * $item->quantity);
            $order->update(['total_price' => $total]);
        });
    }
}
