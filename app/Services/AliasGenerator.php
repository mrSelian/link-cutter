<?php
namespace App\Services;

use App\Domain\AliasGeneratorInterface;

class AliasGenerator implements AliasGeneratorInterface
{
    public function generate(): string
    {
       return Math::to_base(random_int(1000000, 999999999999), 62);
    }
}
