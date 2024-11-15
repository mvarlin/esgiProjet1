<?php

// src/Doctrine/Type/BinaryUuidType.php

namespace App\Doctrine\Type;

use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\Type;

class BinaryUuidType extends Type
{
    const BINARY_UUID = 'binary_uuid';

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return 'BINARY(16)';
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        // Conversion en chaîne UUID si nécessaire (ex. ramsey/uuid)
        return $value !== null ? bin2hex($value) : null;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value !== null ? hex2bin($value) : null;
    }

    public function getName()
    {
        return self::BINARY_UUID;
    }
}
