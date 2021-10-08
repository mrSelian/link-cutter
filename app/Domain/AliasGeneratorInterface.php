<?php

namespace App\Domain;

interface AliasGeneratorInterface
{
    public function generate(): string;
}
