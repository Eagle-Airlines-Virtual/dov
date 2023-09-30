<?php

namespace App\Contracts;

use App\Exceptions\InvalidIdentity;

interface Type
{
    public static function getType(string $value): string;

    public function __toString(): string;

    public function __toArray(): array;

}
