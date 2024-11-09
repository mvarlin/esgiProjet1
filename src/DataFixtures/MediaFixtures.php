<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Serie;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Collections\Expr\Value;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Faker\Factory;

class MediaFixtures extends Fixture
{
    public const MAX_MEDIA = 100;

    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $fixturesPath = __DIR__ . '/../../fixtures/media.yaml';
        $data = Yaml::parseFile($fixturesPath);
        $media = random_int(min: 0, max: 1) === 0 ? new Movie() : new Serie();
        $title = $media instanceof Movie ? 'Film' : 'Série';
        //faker Film ou Série
        // $faker->name($title);
        // $media->setTitle($faker->name($mediaData['title']));
        
        for ($i=0; $i < self::MAX_MEDIA ; $i++) { 
            $media = new Media();
            $media->setMediaType(random_int(0, 1) === 0 ? MediaTypeEnum::MOVIE : MediaTypeEnum::TV_SHOW); // A changer
            // $media = random_int(min: 0, max: 1) === 0 ? new Movie() : new Serie(); // A changer
            // $media->setTitle(title: $mediaData['title']);
            $media->setTitle(title: $faker->name($title));
            $media->setShortDescription(short_description: $faker->realText(50));
            $media->setLongDescription(long_description: $faker->realText(200));
            $media->setReleaseDate(release_date: $faker->dateTimeBetween('now', '+1 year'));
            $media->setCoverImage(cover_image: 'azertyuiop');
            $this->addStaff(media: $media);
            $this->addStream(media: $media);
            $manager->persist($media);
        }
        $manager->flush();
    }

    protected function addStaff(Media $media): void
    {
        $faker = Factory::create();
        $staff = [];
        $roles = ['Réalisateur', 'Scénariste', 'Compositeur', 'Producteur', 'Directeur de la photographie', 'Monteur', 'Costumier', 'Maquilleur', 'Cascades'];
        foreach ($roles as $role) {
            $staff[] = ['name' => $faker->name(), 'role' => $role, 'image' => 'https://i.pravatar.cc/500/150?u=Jane+Doe'];
        }
        $media->setStaff(staff: $staff);
    }

    protected function addStream(Media $media): void
    {
        $faker = Factory::create();
        $stream = [];
        $rolesStream = ['Réalisateur', 'Acteur'];
        foreach ($rolesStream as $roleStream) {
            if ($roleStream === 'Réalisateur') {
                $stream[] = ['name' => $faker->name(), 'role' => $roleStream, 'image' => 'https://i.pravatar.cc/500/150?u=Jane+Doe'];
            } else {    
                for ($i = 0; $i < random_int(min: 2, max: 5); $i++) {
                    $stream[] = ['name' => $faker->name(), 'role' => $roleStream, 'image' => 'https://i.pravatar.cc/500/150?u=Jane+Doe'];
                }
            }
        }
        $media->setStream(stream: $stream);
    }
}