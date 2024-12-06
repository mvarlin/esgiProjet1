<?php    
namespace App\DataFixtures;

use Faker\Provider\Base;
use Faker\Factory;

class CustomProvider extends Base
{
    public function staff(): array
    {
        $faker = Factory::create();
        $staff = [];
        $roles = ['Réalisateur', 'Scénariste', 'Compositeur', 'Producteur', 'Directeur de la photographie', 'Monteur', 'Costumier', 'Maquilleur', 'Cascades'];
        foreach ($roles as $role) {
            $name = $faker->name();
            $staff[] = ['name' => $name, 'role' => $role, 'image' => 'https://i.pravatar.cc/500/150?u='.$name];
        }
        return $staff;
    }

    public function stream(): array
    {
        $faker = Factory::create();
        $stream = []; 
        for ($i = 0; $i < random_int(min: 2, max: 7); $i++) {
            $name = $faker->name();
            $characterName = $faker->firstName();
            $stream[] = ['name' => $name, 'characterName' => $characterName, 'role' => 'Acteur', 'image' => 'https://i.pravatar.cc/500/150?u='.$name];
        }
        return $stream;
    }
}