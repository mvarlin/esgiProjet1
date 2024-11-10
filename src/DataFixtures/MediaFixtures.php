<?php

namespace App\DataFixtures;

use App\Entity\Episode;
use App\Entity\Media;
use App\Entity\Movie;
use App\Entity\Season;
use App\Entity\Serie;
use DateTimeImmutable;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class MediaFixtures extends Fixture
{
    public const MAX_MEDIAS = 100;
    public const MAX_SEASONS = 10;
    public const MAX_EPISODES = 24;

    public function load(ObjectManager $manager): void
    {
        $medias = [];
        $this->createMedia(manager: $manager, medias: $medias);
        $manager->flush();
    }

    protected function createMedia(ObjectManager $manager, array &$medias): void
    {
        for ($i=0; $i < self::MAX_MEDIAS ; $i++) { 
            $faker = Factory::create();
            $media = random_int(min: 0, max: 1) === 0 ? new Movie() : new Serie();
            $type = $media instanceof Movie ? 'Film' : 'Série';
            $media->setTitle(title: $faker->name($type));
            $media->setShortDescription(short_description: $faker->realText(50));
            $media->setLongDescription(long_description: $faker->realText(200));
            $media->setReleaseDate(release_date: $faker->dateTimeBetween('now', '+1 year'));
            $media->setCoverImage(cover_image: 'azertyuiop');
            $this->addStaff(media: $media);
            $this->addStream(media: $media);
            if($media instanceof Serie){
                $this->createSeasons(manager: $manager, media: $media);
            }
            $manager->persist(object: $media);
            $medias[] = $media;
        }
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

    protected function createSeasons(ObjectManager $manager, Serie $media): void
    {
        for ($i = 0; $i < random_int(min: 1, max: self::MAX_SEASONS); $i++) { 
            $season = new Season();
            $season->setSeasonNumber(season_number: $i + 1);
            $season->setSerie(serie: $media);
            $manager->persist(object: $season);
            $this->createEpisodes(manager: $manager, season: $season);
        }
        
    }

    protected function createEpisodes(ObjectManager $manager, Season $season): void
    {
        for ($i = 0; $i < random_int(min: 1, max: self::MAX_EPISODES); $i++) { 
            $episode = new Episode();
            $episode->setTitle(title: 'Episode '. $i + 1);
            $episode->setDuration(duration: random_int(min: 10, max: 60));
            $episode->setReleaseDate(release_date: new DateTimeImmutable());
            $episode->setSeason(season: $season);
            $manager->persist(object: $episode);
        }
        
    }
}