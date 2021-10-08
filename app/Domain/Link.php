<?php

namespace App\Domain;

use Exception;

class Link
{
    protected string $alias;
    protected string $targetLink;
    protected ?int $ownerId;
    protected bool $deleted;
    protected ?int $id = null;
    protected int $clicks = 0;

    protected function __construct(string $targetLink, ?int $ownerId, float $deleted)
    {
        $this->targetLink = $targetLink;
        $this->ownerId = $ownerId;
        $this->deleted = $deleted;
    }

    public static function create(
        string $targetLink,
        ?int   $ownerId,
        bool   $deleted = false
    ): self
    {
        return new self($targetLink, $ownerId, $deleted);
    }

    public static function from(
        string $alias,
        string $targetLink,
        ?int   $ownerId,
        bool   $deleted,
        int    $clicks,
        ?int   $id
    ): self
    {
        $self = new self($targetLink, $ownerId, $deleted);
        $self->id = $id;
        $self->alias = $alias;
        $self->clicks = $clicks;

        return $self;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getAlias(): string
    {
        return $this->alias;
    }

    public function getTargetLink(): string
    {
        return $this->targetLink;
    }

    public function getOwnerId(): ?int
    {
        return $this->ownerId;
    }

    public function getAliasPath(): string
    {
        return getenv('APP_URL') . '/' . $this->alias;
    }

    public function getClicks(): int
    {
        return $this->clicks;
    }

    public function click()
    {
        $this->clicks++;
    }

    public function isDeleted(): bool
    {
        return $this->deleted;
    }

    public function updateTargetLink(string $link)
    {
        $this->targetLink = $link;
    }

    public function updateAlias(?string $alias, AliasGeneratorInterface $aliasGenerator)
    {
        $newAlias = $alias ?? $aliasGenerator->generate();

        if ($this->aliasIsCorrect($newAlias) != true) throw new Exception('Указанный алиас имеет некорректный формат!');
        $this->alias = $newAlias;

        return $this;
    }

    public function delete()
    {
        $this->deleted = true;
    }

    protected function aliasIsCorrect(string $alias): bool
    {
        return (bool)preg_match('/^[a-zA-Z0-9-_]{4,}$/', $alias);
    }
}
