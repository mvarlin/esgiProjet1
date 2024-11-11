<?php

namespace App\DataFixtures;

use App\Entity\Language;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\Yaml\Yaml;

class LanguageFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $fixturesPath = __DIR__ . '/../../fixtures/Language.yaml';
        $data = Yaml::parseFile($fixturesPath);

        foreach ($data[Language::class] as $reference => $languageData) {
            $Language = new Language();
            $Language->setName($languageData['name']);
            $Language->setCode($languageData['code']);
            $manager->persist($Language);
        }

        // $manager->flush();
    }
}