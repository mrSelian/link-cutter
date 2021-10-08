<?php

namespace App\Domain;

interface LinkRepositoryInterface
{
    public function getByAlias(?string $alias): ?Link;

    public function getById(int $id): ?Link;

    public function getAllAvailableByOwner(?int $ownerId);

    public function save(Link $link);

    public function delete(Link $link);
}
