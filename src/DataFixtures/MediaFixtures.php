<?php

namespace App\DataFixtures;

use App\Entity\Media;
use App\Enum\MediaTypeEnum;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;
use Faker\Factory;

class MediaFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();
        $fixturesPath = __DIR__ . '/../../fixtures/media.yaml';
        $data = Yaml::parseFile($fixturesPath);

        foreach ($data[Media::class] as $reference => $mediaData) {
            $media = new Media();
            $media->setMediaType(random_int(0, 1) === 1 ? MediaTypeEnum::MOVIE : MediaTypeEnum::TV_SHOW); // A changer
            // $media = random_int(min: 0, max: 1) === 0 ? new Movie() : new Serie(); // A changer
            $media->setTitle($mediaData['title']);
            $media->setShortDescription($mediaData['shortDescription']);
            $media->setLongDescription($mediaData['longDescription']);
            $media->setReleaseDate($faker->dateTimeBetween('now', '+1 year'));
            $media->setCoverImage($mediaData['coverImage']);
            $manager->persist($media);
        }

        $manager->flush();
    }
}