<?php    
namespace App\Faker\CustomProvider;

use Faker\Provider\Base;
use Faker\Factory;

class CustomProvider extends Base
{
    public function customProvider()
    {
        // Retourne une valeur factice personnalisée
        return 'valeur_personnalisée';
    }

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
        $rolesStream = ['Réalisateur', 'Acteur'];
        foreach ($rolesStream as $roleStream) {
            $name = $faker->name();
            if ($roleStream === 'Réalisateur') {
                $stream[] = ['name' => $name, 'role' => $roleStream, 'image' => 'https://i.pravatar.cc/500/150?u='.$name];
            } else {    
                for ($i = 0; $i < random_int(min: 2, max: 5); $i++) {
                    $stream[] = ['name' => $name, 'role' => $roleStream, 'image' => 'https://i.pravatar.cc/500/150?u='.$name];
                }
            }
        }
        return $stream;
    }
}