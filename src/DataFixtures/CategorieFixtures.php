<?php

namespace App\DataFixtures;

use App\Entity\Categorie;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class CategorieFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fixturesPath = __DIR__ . '/../../fixtures/categorie.yaml';
        $data = Yaml::parseFile($fixturesPath);

        foreach ($data[Categorie::class] as $reference => $categorieData) {
            $categorie = new Categorie();
            $categorie->setName($categorieData['name']);
            $categorie->setLabel($categorieData['label']);
            $manager->persist($categorie);
        }

        // $manager->flush();
    }
}