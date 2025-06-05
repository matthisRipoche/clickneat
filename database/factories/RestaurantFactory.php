<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class RestaurantFactory extends Factory
{
    // On garde ça en statique pour qu'elle soit partagée entre chaque appel
    protected static array $nomsDispo = [
        'Le Bistrot Parisien',
        'Chez Lulu',
        'La Table de Mamy',
        'Le Petit Moulin',
        'Au Bon Fromage',
        'La Belle Assiette',
        'L’Épicurien',
        'Le Gourmet du Coin',
        'La Terrasse de Gaston',
        'Le Panier à Pain'
    ];

    public function definition(): array
    {
        // Mélange une seule fois si tu veux randomiser avant la 1ère utilisation
        if (count(self::$nomsDispo) === 10) {
            shuffle(self::$nomsDispo);
        }

        return [
            'name' => array_shift(self::$nomsDispo),
        ];
    }
}
