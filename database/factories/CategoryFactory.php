<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    // Liste élargie de catégories possibles
    protected static array $categoriesDispo = [
        'Entrées froides',
        'Entrées chaudes',
        'Salades composées',
        'Plats traditionnels',
        'Plats végétariens',
        'Pizzas',
        'Burgers',
        'Poissons & fruits de mer',
        'Viandes & grillades',
        'Desserts maison',
        'Glaces & sorbets',
        'Boissons chaudes',
        'Boissons fraîches',
        'Vins rouges',
        'Vins blancs',
        'Bières artisanales',
        'Cocktails',
        'Apéritifs',
        'Digestifs',
        'Menus enfants',
    ];

    public function definition(): array
    {
        if (count(self::$categoriesDispo) === 20) {
            shuffle(self::$categoriesDispo);
        }

        return [
            'name' => array_shift(self::$categoriesDispo),
            'restaurant_id' => random_int(1, 3), // ou factory si t’as les relations
        ];
    }
}
