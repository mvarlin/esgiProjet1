<?php

namespace App\Doctrine\CharType;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Symfony\Component\Uid\Uuid;

class CharUuidType extends Type
{
    const CHAR_UUID = 'uuid'; // Le type unique

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }
        return Uuid::fromString($value); // Convertir la chaîne UUID en un objet UUID
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if ($value === null) {
            return null;
        }
        return $value->toRfc4122(); // Convertir l'objet UUID en une chaîne RFC4122
    }

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "CHAR(36)";  // Type CHAR(36) dans la base de données
    }

    public function getName()
    {
        return self::CHAR_UUID;  // Nom du type
    }
}
